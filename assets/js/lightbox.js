/**
 * Lightbox JavaScript
 * Modern, accessible lightbox for images and galleries
 *
 * @package DThree_Gutenberg
 */

(function() {
    'use strict';

    class DThreeLightbox {
        constructor() {
            this.lightboxEl = null;
            this.images = [];
            this.currentIndex = 0;
            this.isZoomed = false;
            this.zoomLevel = 1;
            this.isDragging = false;
            this.dragStart = { x: 0, y: 0 };
            this.imagePosition = { x: 0, y: 0 };
            
            this.init();
        }

        init() {
            this.createLightbox();
            this.bindEvents();
            this.initializeGalleries();
        }

        createLightbox() {
            const lightbox = document.createElement('div');
            lightbox.className = 'dthree-lightbox';
            lightbox.setAttribute('role', 'dialog');
            lightbox.setAttribute('aria-modal', 'true');
            lightbox.setAttribute('aria-hidden', 'true');
            lightbox.setAttribute('aria-label', 'Image lightbox');
            
            lightbox.innerHTML = `
                <div class="dthree-lightbox-content">
                    <div class="dthree-lightbox-loading">
                        <div class="dthree-lightbox-spinner"></div>
                    </div>
                    <img class="dthree-lightbox-image" src="" alt="" />
                    <div class="dthree-lightbox-caption">
                        <div class="dthree-lightbox-caption-text"></div>
                    </div>
                </div>
                
                <button class="dthree-lightbox-close" aria-label="Close lightbox">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                
                <button class="dthree-lightbox-prev" aria-label="Previous image">
                    <span aria-hidden="true">&#8249;</span>
                    <span class="sr-only">Previous</span>
                </button>
                
                <button class="dthree-lightbox-next" aria-label="Next image">
                    <span aria-hidden="true">&#8250;</span>
                    <span class="sr-only">Next</span>
                </button>
                
                <div class="dthree-lightbox-counter" aria-live="polite"></div>
                
                <div class="dthree-lightbox-zoom">
                    <button class="dthree-lightbox-zoom-btn" data-action="zoom-in" aria-label="Zoom in">
                        <span aria-hidden="true">+</span>
                    </button>
                    <button class="dthree-lightbox-zoom-btn" data-action="zoom-out" aria-label="Zoom out">
                        <span aria-hidden="true">−</span>
                    </button>
                    <button class="dthree-lightbox-zoom-btn" data-action="zoom-reset" aria-label="Reset zoom">
                        <span aria-hidden="true">↺</span>
                    </button>
                </div>
                
                <div class="dthree-lightbox-thumbnails"></div>
            `;
            
            document.body.appendChild(lightbox);
            this.lightboxEl = lightbox;
        }

        bindEvents() {
            const close = this.lightboxEl.querySelector('.dthree-lightbox-close');
            const prev = this.lightboxEl.querySelector('.dthree-lightbox-prev');
            const next = this.lightboxEl.querySelector('.dthree-lightbox-next');
            const zoomBtns = this.lightboxEl.querySelectorAll('.dthree-lightbox-zoom-btn');
            const image = this.lightboxEl.querySelector('.dthree-lightbox-image');
            
            close.addEventListener('click', () => this.close());
            prev.addEventListener('click', () => this.prev());
            next.addEventListener('click', () => this.next());
            
            // Zoom controls
            zoomBtns.forEach(btn => {
                btn.addEventListener('click', (e) => {
                    const action = e.currentTarget.dataset.action;
                    if (action === 'zoom-in') this.zoomIn();
                    else if (action === 'zoom-out') this.zoomOut();
                    else if (action === 'zoom-reset') this.resetZoom();
                });
            });
            
            // Image dragging when zoomed
            image.addEventListener('mousedown', (e) => this.startDrag(e));
            image.addEventListener('mousemove', (e) => this.drag(e));
            image.addEventListener('mouseup', () => this.endDrag());
            image.addEventListener('mouseleave', () => this.endDrag());
            
            // Click outside to close
            this.lightboxEl.addEventListener('click', (e) => {
                if (e.target === this.lightboxEl) {
                    this.close();
                }
            });
            
            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (!this.lightboxEl.classList.contains('active')) return;
                
                switch(e.key) {
                    case 'Escape':
                        this.close();
                        break;
                    case 'ArrowLeft':
                        this.prev();
                        break;
                    case 'ArrowRight':
                        this.next();
                        break;
                    case '+':
                    case '=':
                        this.zoomIn();
                        break;
                    case '-':
                        this.zoomOut();
                        break;
                    case '0':
                        this.resetZoom();
                        break;
                }
            });
        }

        initializeGalleries() {
            // Auto-detect WordPress galleries
            const galleries = document.querySelectorAll('.wp-block-gallery, .gallery, .dthree-image-slider');
            
            galleries.forEach(gallery => {
                const images = gallery.querySelectorAll('img');
                const galleryImages = Array.from(images).map(img => ({
                    src: img.src,
                    full: img.dataset.fullUrl || img.src,
                    alt: img.alt || '',
                    caption: img.getAttribute('data-caption') || img.closest('figure')?.querySelector('figcaption')?.textContent || ''
                }));
                
                images.forEach((img, index) => {
                    if (!img.classList.contains('dthree-lightbox-trigger')) {
                        img.classList.add('dthree-lightbox-trigger');
                        img.style.cursor = 'pointer';
                        
                        img.addEventListener('click', (e) => {
                            e.preventDefault();
                            this.open(galleryImages, index);
                        });
                    }
                });
            });
            
            // Single images with data-lightbox attribute
            const singleImages = document.querySelectorAll('img[data-lightbox]');
            singleImages.forEach(img => {
                img.classList.add('dthree-lightbox-trigger');
                img.style.cursor = 'pointer';
                
                img.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.open([{
                        src: img.src,
                        full: img.dataset.fullUrl || img.src,
                        alt: img.alt || '',
                        caption: img.dataset.caption || ''
                    }], 0);
                });
            });
        }

        open(images, index = 0) {
            this.images = images;
            this.currentIndex = index;
            this.showImage(index);
            
            this.lightboxEl.classList.add('active');
            this.lightboxEl.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
            
            // Focus management
            this.previousFocus = document.activeElement;
            this.lightboxEl.querySelector('.dthree-lightbox-close').focus();
            
            this.updateThumbnails();
        }

        close() {
            this.lightboxEl.classList.remove('active');
            this.lightboxEl.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
            this.resetZoom();
            
            // Restore focus
            if (this.previousFocus) {
                this.previousFocus.focus();
            }
        }

        showImage(index) {
            if (index < 0 || index >= this.images.length) return;
            
            this.currentIndex = index;
            const imageData = this.images[index];
            
            const img = this.lightboxEl.querySelector('.dthree-lightbox-image');
            const loading = this.lightboxEl.querySelector('.dthree-lightbox-loading');
            const caption = this.lightboxEl.querySelector('.dthree-lightbox-caption-text');
            const counter = this.lightboxEl.querySelector('.dthree-lightbox-counter');
            
            // Show loading
            loading.style.display = 'block';
            img.style.display = 'none';
            
            // Load image
            const tempImg = new Image();
            tempImg.onload = () => {
                img.src = imageData.full;
                img.alt = imageData.alt;
                img.style.display = 'block';
                loading.style.display = 'none';
                this.resetZoom();
            };
            tempImg.src = imageData.full;
            
            // Update caption
            if (imageData.caption) {
                caption.textContent = imageData.caption;
                caption.parentElement.style.display = 'block';
            } else {
                caption.parentElement.style.display = 'none';
            }
            
            // Update counter
            if (this.images.length > 1) {
                counter.textContent = `${index + 1} / ${this.images.length}`;
                counter.style.display = 'block';
            } else {
                counter.style.display = 'none';
            }
            
            // Update navigation buttons
            const prevBtn = this.lightboxEl.querySelector('.dthree-lightbox-prev');
            const nextBtn = this.lightboxEl.querySelector('.dthree-lightbox-next');
            
            if (this.images.length > 1) {
                prevBtn.style.display = 'flex';
                nextBtn.style.display = 'flex';
                prevBtn.disabled = index === 0;
                nextBtn.disabled = index === this.images.length - 1;
            } else {
                prevBtn.style.display = 'none';
                nextBtn.style.display = 'none';
            }
            
            this.updateActiveThumbnail();
        }

        prev() {
            if (this.currentIndex > 0) {
                this.showImage(this.currentIndex - 1);
            }
        }

        next() {
            if (this.currentIndex < this.images.length - 1) {
                this.showImage(this.currentIndex + 1);
            }
        }

        updateThumbnails() {
            if (this.images.length <= 1) return;
            
            const container = this.lightboxEl.querySelector('.dthree-lightbox-thumbnails');
            container.innerHTML = '';
            
            this.images.forEach((imageData, index) => {
                const thumb = document.createElement('img');
                thumb.src = imageData.src;
                thumb.alt = imageData.alt;
                thumb.className = 'dthree-lightbox-thumbnail';
                thumb.dataset.index = index;
                
                if (index === this.currentIndex) {
                    thumb.classList.add('active');
                }
                
                thumb.addEventListener('click', () => {
                    this.showImage(index);
                });
                
                container.appendChild(thumb);
            });
        }

        updateActiveThumbnail() {
            const thumbnails = this.lightboxEl.querySelectorAll('.dthree-lightbox-thumbnail');
            thumbnails.forEach((thumb, index) => {
                thumb.classList.toggle('active', index === this.currentIndex);
            });
        }

        zoomIn() {
            this.zoomLevel = Math.min(this.zoomLevel + 0.5, 3);
            this.applyZoom();
        }

        zoomOut() {
            this.zoomLevel = Math.max(this.zoomLevel - 0.5, 1);
            this.applyZoom();
        }

        resetZoom() {
            this.zoomLevel = 1;
            this.imagePosition = { x: 0, y: 0 };
            this.isZoomed = false;
            this.applyZoom();
        }

        applyZoom() {
            const img = this.lightboxEl.querySelector('.dthree-lightbox-image');
            
            if (this.zoomLevel > 1) {
                img.style.transform = `scale(${this.zoomLevel}) translate(${this.imagePosition.x}px, ${this.imagePosition.y}px)`;
                img.classList.add('zoomed');
                this.isZoomed = true;
            } else {
                img.style.transform = '';
                img.classList.remove('zoomed');
                this.isZoomed = false;
            }
        }

        startDrag(e) {
            if (!this.isZoomed) return;
            
            this.isDragging = true;
            this.dragStart = {
                x: e.clientX - this.imagePosition.x,
                y: e.clientY - this.imagePosition.y
            };
            e.preventDefault();
        }

        drag(e) {
            if (!this.isDragging) return;
            
            this.imagePosition = {
                x: e.clientX - this.dragStart.x,
                y: e.clientY - this.dragStart.y
            };
            this.applyZoom();
        }

        endDrag() {
            this.isDragging = false;
        }
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            new DThreeLightbox();
        });
    } else {
        new DThreeLightbox();
    }

    // Export for programmatic access
    window.DThreeLightbox = DThreeLightbox;

})();
