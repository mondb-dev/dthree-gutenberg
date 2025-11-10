/**
 * Design System Admin JavaScript
 *
 * @package DThree_Gutenberg
 */

(function($) {
    'use strict';

    let isBuilding = false;
    let previewTimeout;

    $(document).ready(function() {
        initializeTabs();
        initializeColorPickers();
        initializeBuildButton();
        initializePreviewButton();
        initializeExportImport();
        initializeLivePreview();
        initializeFormWatchers();
    });

    /**
     * Initialize tab switching
     */
    function initializeTabs() {
        $('.nav-tab').on('click', function(e) {
            e.preventDefault();
            
            const targetTab = $(this).attr('href').substring(1);
            
            // Update nav tabs
            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            
            // Update content
            $('.tab-content').removeClass('active');
            $(`#${targetTab}`).addClass('active');
            
            // Update URL hash without scrolling
            if (history.pushState) {
                history.pushState(null, null, `#${targetTab}`);
            }
        });

        // Handle initial hash
        const hash = window.location.hash.substring(1);
        if (hash && $(`#${hash}`).length) {
            $(`.nav-tab[href="#${hash}"]`).trigger('click');
        }
    }

    /**
     * Initialize color pickers
     */
    function initializeColorPickers() {
        if ($.fn.wpColorPicker) {
            $('.color-picker').wpColorPicker({
                change: function(event, ui) {
                    const color = ui.color.toString();
                    $(this).siblings('.color-preview').css('background-color', color);
                    triggerLivePreview();
                },
                clear: function() {
                    $(this).siblings('.color-preview').css('background-color', '');
                    triggerLivePreview();
                }
            });
        }
    }

    /**
     * Initialize build button functionality
     */
    function initializeBuildButton() {
        $('#dthree-build-assets').on('click', function() {
            if (isBuilding) return;
            
            buildAssets();
        });
    }

    /**
     * Build design system assets
     */
    function buildAssets() {
        if (isBuilding) return;
        
        isBuilding = true;
        const $button = $('#dthree-build-assets');
        const $status = $('#dthree-build-status');
        
        // Update UI state
        $button.prop('disabled', true).addClass('loading');
        $button.find('span').text(dthreeDesignSystem.strings.building);
        
        $status.removeClass('success error').addClass('building');
        $status.html(`<p>${dthreeDesignSystem.strings.building}</p>`);

        // Make AJAX request
        $.ajax({
            url: dthreeDesignSystem.ajaxurl,
            type: 'POST',
            data: {
                action: 'dthree_build_assets',
                nonce: dthreeDesignSystem.nonce
            },
            success: function(response) {
                if (response.success) {
                    $status.removeClass('building').addClass('success');
                    $status.html(`<p><strong>Success!</strong> ${response.data.message}</p>`);
                    
                    // Show success message
                    showNotification(dthreeDesignSystem.strings.built, 'success');
                    
                    // Refresh page to load new assets
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                } else {
                    handleBuildError(response.data.message || dthreeDesignSystem.strings.error);
                }
            },
            error: function(xhr, status, error) {
                handleBuildError(`${dthreeDesignSystem.strings.error}: ${error}`);
            },
            complete: function() {
                isBuilding = false;
                $button.prop('disabled', false).removeClass('loading');
                $button.find('span').text('Build Assets');
            }
        });
    }

    /**
     * Handle build errors
     */
    function handleBuildError(message) {
        const $status = $('#dthree-build-status');
        $status.removeClass('building').addClass('error');
        $status.html(`<p><strong>Error:</strong> ${message}</p>`);
        showNotification(message, 'error');
    }

    /**
     * Initialize preview functionality
     */
    function initializePreviewButton() {
        $('#dthree-preview-btn').on('click', function() {
            generatePreview();
        });
    }

    /**
     * Generate preview of current settings
     */
    function generatePreview() {
        const $button = $('#dthree-preview-btn');
        $button.prop('disabled', true).addClass('loading');

        const formData = $('form').serialize();
        
        $.ajax({
            url: dthreeDesignSystem.ajaxurl,
            type: 'POST',
            data: {
                action: 'dthree_preview_changes',
                nonce: dthreeDesignSystem.nonce,
                settings: JSON.stringify(getFormDataAsObject())
            },
            success: function(response) {
                if (response.success) {
                    // Apply preview styles
                    applyPreviewStyles(response.data.css);
                    showNotification('Preview generated!', 'success');
                } else {
                    showNotification('Error generating preview', 'error');
                }
            },
            error: function() {
                showNotification('Error generating preview', 'error');
            },
            complete: function() {
                $button.prop('disabled', false).removeClass('loading');
            }
        });
    }

    /**
     * Apply preview styles to the page
     */
    function applyPreviewStyles(css) {
        // Remove existing preview styles
        $('#dthree-preview-styles').remove();
        
        // Add new preview styles
        $('<style id="dthree-preview-styles">')
            .text(css)
            .appendTo('head');
    }

    /**
     * Get form data as object
     */
    function getFormDataAsObject() {
        const formArray = $('form').serializeArray();
        const formObject = {};
        
        formArray.forEach(function(item) {
            const keys = item.name.replace(/\]/g, '').split('[');
            let current = formObject;
            
            for (let i = 0; i < keys.length - 1; i++) {
                if (keys[i]) {
                    if (!current[keys[i]]) {
                        current[keys[i]] = {};
                    }
                    current = current[keys[i]];
                }
            }
            
            const lastKey = keys[keys.length - 1];
            if (lastKey) {
                current[lastKey] = item.value;
            }
        });
        
        return formObject.dthree_design_system || {};
    }

    /**
     * Initialize export/import functionality
     */
    function initializeExportImport() {
        // Export functionality
        $('#dthree-export-btn').on('click', function() {
            exportDesignSystem();
        });

        // Import modal
        $('#dthree-import-btn').on('click', function() {
            $('#dthree-import-modal').show();
        });

        // Close modal
        $('.dthree-modal-close, .dthree-modal').on('click', function(e) {
            if (e.target === this) {
                $('#dthree-import-modal').hide();
            }
        });

        // Import functionality
        $('#dthree-import-confirm').on('click', function() {
            importDesignSystem();
        });
    }

    /**
     * Export design system settings
     */
    function exportDesignSystem() {
        const $button = $('#dthree-export-btn');
        $button.prop('disabled', true).addClass('loading');

        $.ajax({
            url: dthreeDesignSystem.ajaxurl,
            type: 'POST',
            data: {
                action: 'dthree_export_design_system',
                nonce: dthreeDesignSystem.nonce
            },
            success: function(response) {
                if (response.success) {
                    // Create download link
                    const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(response.data.data, null, 2));
                    const downloadAnchorNode = document.createElement('a');
                    downloadAnchorNode.setAttribute("href", dataStr);
                    downloadAnchorNode.setAttribute("download", response.data.filename);
                    document.body.appendChild(downloadAnchorNode);
                    downloadAnchorNode.click();
                    downloadAnchorNode.remove();
                    
                    showNotification(dthreeDesignSystem.strings.exported, 'success');
                } else {
                    showNotification('Error exporting design system', 'error');
                }
            },
            error: function() {
                showNotification('Error exporting design system', 'error');
            },
            complete: function() {
                $button.prop('disabled', false).removeClass('loading');
            }
        });
    }

    /**
     * Import design system settings
     */
    function importDesignSystem() {
        const fileInput = document.getElementById('dthree-import-file');
        const file = fileInput.files[0];
        
        if (!file) {
            showNotification('Please select a file to import', 'error');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            try {
                const importData = JSON.parse(e.target.result);
                
                // Validate import data
                if (!importData.settings) {
                    throw new Error('Invalid import file format');
                }

                const $button = $('#dthree-import-confirm');
                $button.prop('disabled', true).addClass('loading');

                $.ajax({
                    url: dthreeDesignSystem.ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'dthree_import_design_system',
                        nonce: dthreeDesignSystem.nonce,
                        data: JSON.stringify(importData)
                    },
                    success: function(response) {
                        if (response.success) {
                            showNotification(dthreeDesignSystem.strings.imported, 'success');
                            $('#dthree-import-modal').hide();
                            
                            // Reload page to show imported settings
                            setTimeout(() => {
                                location.reload();
                            }, 1500);
                        } else {
                            showNotification(response.data.message || 'Error importing design system', 'error');
                        }
                    },
                    error: function() {
                        showNotification('Error importing design system', 'error');
                    },
                    complete: function() {
                        $button.prop('disabled', false).removeClass('loading');
                    }
                });
                
            } catch (error) {
                showNotification('Invalid import file: ' + error.message, 'error');
            }
        };
        
        reader.readAsText(file);
    }

    /**
     * Initialize live preview functionality
     */
    function initializeLivePreview() {
        updateLivePreview();
    }

    /**
     * Update live preview with current values
     */
    function updateLivePreview() {
        const $preview = $('#dthree-live-preview');
        
        // Update color swatches
        $preview.find('.primary-swatch').css('background-color', $('[name*="[colors][primary]"]').val());
        $preview.find('.secondary-swatch').css('background-color', $('[name*="[colors][secondary]"]').val());
        $preview.find('.success-swatch').css('background-color', $('[name*="[colors][success]"]').val());
        $preview.find('.warning-swatch').css('background-color', $('[name*="[colors][warning]"]').val());
        
        // Update typography preview
        const primaryFont = $('[name*="[font_family_primary][family]"]').val();
        if (primaryFont) {
            $preview.find('h1, h2, h3, p').css('font-family', primaryFont);
        }
        
        // Update spacing previews in real-time
        updateSpacingPreviews();
        
        // Update border radius previews in real-time
        updateBorderRadiusPreviews();
        
        // Update shadow previews in real-time
        updateShadowPreviews();
        
        // Update button previews
        updateButtonPreviews($preview);
    }

    /**
     * Update spacing previews
     */
    function updateSpacingPreviews() {
        $('[name*="[spacing][scale]"]').each(function() {
            const value = $(this).val();
            const $preview = $(this).siblings('.spacing-preview');
            if ($preview.length && value) {
                $preview.css({
                    'width': value,
                    'height': value
                });
            }
        });
    }

    /**
     * Update border radius previews
     */
    function updateBorderRadiusPreviews() {
        $('[name*="[border_radius]"]').each(function() {
            const value = $(this).val();
            const $preview = $(this).siblings('.radius-preview');
            if ($preview.length && value) {
                $preview.css('border-radius', value);
            }
        });
    }

    /**
     * Update shadow previews
     */
    function updateShadowPreviews() {
        $('[name*="[shadows]"]').each(function() {
            const value = $(this).val();
            const $preview = $(this).siblings('.shadow-preview');
            if ($preview.length && value) {
                $preview.css('box-shadow', value);
            }
        });
    }

    /**
     * Update button previews
     */
    function updateButtonPreviews($preview) {
        // This would update button styles based on current form values
        // Implementation depends on button configuration structure
    }

    /**
     * Trigger live preview update with debouncing
     */
    function triggerLivePreview() {
        clearTimeout(previewTimeout);
        previewTimeout = setTimeout(function() {
            updateLivePreview();
        }, 500);
    }

    /**
     * Initialize form watchers for live preview
     */
    function initializeFormWatchers() {
        // Watch all form inputs for changes
        $('form').on('input change', 'input, textarea, select', function() {
            triggerLivePreview();
        });

        // Watch specifically for color changes
        $(document).on('input change', '.color-picker', function() {
            const color = $(this).val();
            $(this).siblings('.color-preview').css('background-color', color);
            triggerLivePreview();
        });
        
        // Initialize responsive features
        initializeResponsiveFeatures();
    }

    /**
     * Initialize responsive design features
     */
    function initializeResponsiveFeatures() {
        // Device preview handlers
        $(document).on('click', '.device-btn', function(e) {
            e.preventDefault();
            
            const device = $(this).data('device');
            
            // Update active button
            $('.device-btn').removeClass('active');
            $(this).addClass('active');
            
            // Update active preview
            $('.preview-device').removeClass('active');
            $('.preview-device.' + device).addClass('active');
            
            // Update preview content based on device
            updateDevicePreview(device);
        });

        // Breakpoint input validation
        $(document).on('input', '.breakpoint-input', function() {
            validateNumericInput($(this), 0, 2000, 'px');
        });

        // Scale factor input validation
        $(document).on('input', '.scale-factor-input', function() {
            validateNumericInput($(this), 0.5, 3.0, '');
        });

        // Container width input validation
        $(document).on('input', '.container-input', function() {
            validateNumericInput($(this), 200, 2000, 'px');
        });

        // Line height input validation
        $(document).on('input', '.line-height-input', function() {
            validateNumericInput($(this), 0.8, 3.0, '');
        });

        // Live preview updates for responsive settings
        $(document).on('input', '.breakpoint-input, .container-input, .scale-factor-input, .line-height-input', 
            debounce(function() {
                triggerLivePreview();
            }, 300)
        );
    }

    /**
     * Validate numeric input fields
     */
    function validateNumericInput($input, min, max, unit) {
        const value = parseFloat($input.val());
        
        if (value < min || value > max || isNaN(value)) {
            $input.addClass('error');
            $input.attr('title', `Value must be between ${min}${unit} and ${max}${unit}`);
        } else {
            $input.removeClass('error');
            $input.removeAttr('title');
        }
    }

    /**
     * Update device preview content
     */
    function updateDevicePreview(device) {
        const $previewContent = $('.preview-device.' + device + ' .preview-content');
        
        if ($previewContent.length) {
            // Simulate different content for different devices
            const deviceContent = getDeviceContent(device);
            $previewContent.html(deviceContent);
        }
    }

    /**
     * Get content appropriate for specific device
     */
    function getDeviceContent(device) {
        const baseContent = `
            <h3>Design System Preview - ${device.charAt(0).toUpperCase() + device.slice(1)}</h3>
            <p>This is how your design system components will look on ${device} devices.</p>
            <div class="sample-card">
                <h4>Sample Component</h4>
                <p>Responsive design ensures your components look great on all screen sizes.</p>
            </div>
        `;
        
        // Add device-specific elements
        if (device === 'mobile') {
            return baseContent + `
                <p style="font-size: 14px; color: #666;">
                    <strong>Mobile optimization:</strong> Touch-friendly buttons, readable text, efficient layouts.
                </p>
            `;
        } else if (device === 'tablet') {
            return baseContent + `
                <p style="font-size: 15px; color: #666;">
                    <strong>Tablet optimization:</strong> Balanced layouts, medium-sized touch targets.
                </p>
            `;
        } else {
            return baseContent + `
                <p style="font-size: 16px; color: #666;">
                    <strong>Desktop optimization:</strong> Rich layouts, hover states, keyboard navigation.
                </p>
            `;
        }
    }

    /**
     * Debounce function to limit rapid function calls
     */
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    /**
     * Show notification to user
     */
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        $('.dthree-notification').remove();
        
        const notificationClass = type === 'error' ? 'notice-error' : 
                                 type === 'success' ? 'notice-success' : 
                                 'notice-info';
        
        const $notification = $(`
            <div class="notice ${notificationClass} is-dismissible dthree-notification">
                <p>${message}</p>
                <button type="button" class="notice-dismiss">
                    <span class="screen-reader-text">Dismiss this notice.</span>
                </button>
            </div>
        `);
        
        $('.dthree-design-system-admin h1').after($notification);
        
        // Auto-dismiss success notifications
        if (type === 'success') {
            setTimeout(() => {
                $notification.fadeOut();
            }, 5000);
        }
        
        // Handle dismiss button
        $notification.find('.notice-dismiss').on('click', function() {
            $notification.fadeOut();
        });
    }

    /**
     * Initialize sortable functionality for component variations
     */
    function initializeSortable() {
        if ($.fn.sortable) {
            $('.dthree-component-builder').sortable({
                items: '.component-variation',
                placeholder: 'component-placeholder',
                update: function(event, ui) {
                    // Handle reordering
                    triggerLivePreview();
                }
            });
        }
    }

    /**
     * Add new component variation
     */
    function addComponentVariation(type) {
        // Implementation for adding new component variations
        // This would clone an existing variation template and add it to the builder
    }

    /**
     * Remove component variation
     */
    function removeComponentVariation($variation) {
        $variation.fadeOut(function() {
            $(this).remove();
            triggerLivePreview();
        });
    }

    /**
     * Reset design system to defaults
     */
    function resetToDefaults() {
        if (confirm('Are you sure you want to reset all design system settings to defaults? This action cannot be undone.')) {
            // This would reset all form values to defaults
            location.reload();
        }
    }

    /**
     * Copy CSS variables to clipboard
     */
    function copyCSSVariables() {
        // Generate CSS variables string and copy to clipboard
        const formData = getFormDataAsObject();
        let cssVariables = ':root {\n';
        
        // Add color variables
        if (formData.colors) {
            Object.entries(formData.colors).forEach(([key, value]) => {
                cssVariables += `  --dthree-color-${key.replace(/_/g, '-')}: ${value};\n`;
            });
        }
        
        cssVariables += '}';
        
        navigator.clipboard.writeText(cssVariables).then(function() {
            showNotification('CSS variables copied to clipboard!', 'success');
        }, function() {
            showNotification('Failed to copy CSS variables', 'error');
        });
    }

    // Expose functions globally for other scripts
    window.DThreeDesignSystemAdmin = {
        buildAssets: buildAssets,
        generatePreview: generatePreview,
        exportDesignSystem: exportDesignSystem,
        resetToDefaults: resetToDefaults,
        copyCSSVariables: copyCSSVariables,
        showNotification: showNotification
    };

})(jQuery);