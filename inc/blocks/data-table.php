<?php
/**
 * Data Table Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Data Table Block
 */
function dthree_register_data_table_block() {
    register_block_type( 'dthree/data-table', array(
        'api_version' => 2,
        'title'       => __( 'Data Table', 'dthree-gutenberg' ),
        'description' => __( 'Create responsive, sortable data tables with customizable styling.', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'editor-table',
        'keywords'    => array( 'table', 'data', 'spreadsheet', 'grid' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'tableData'     => array(
                'type'    => 'array',
                'default' => array(
                    array( 'Name', 'Position', 'Office', 'Age', 'Salary' ),
                    array( 'Tiger Nixon', 'System Architect', 'Edinburgh', '61', '$320,800' ),
                    array( 'Garrett Winters', 'Accountant', 'Tokyo', '63', '$170,750' ),
                    array( 'Ashton Cox', 'Junior Technical Author', 'San Francisco', '66', '$86,000' ),
                ),
            ),
            'hasHeaderRow' => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'isStriped'    => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'isBordered'   => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'isHoverable'  => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'isSortable'   => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'isResponsive' => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'tableStyle'   => array(
                'type'    => 'string',
                'default' => 'default',
            ),
        ),
        'render_callback' => 'dthree_render_data_table_block',
    ) );
}
add_action( 'init', 'dthree_register_data_table_block' );

/**
 * Render Data Table Block
 */
function dthree_render_data_table_block( $attributes ) {
    $table_data     = isset( $attributes['tableData'] ) ? $attributes['tableData'] : array();
    $has_header     = isset( $attributes['hasHeaderRow'] ) ? $attributes['hasHeaderRow'] : true;
    $is_striped     = isset( $attributes['isStriped'] ) ? $attributes['isStriped'] : true;
    $is_bordered    = isset( $attributes['isBordered'] ) ? $attributes['isBordered'] : true;
    $is_hoverable   = isset( $attributes['isHoverable'] ) ? $attributes['isHoverable'] : true;
    $is_sortable    = isset( $attributes['isSortable'] ) ? $attributes['isSortable'] : true;
    $is_responsive  = isset( $attributes['isResponsive'] ) ? $attributes['isResponsive'] : true;
    $table_style    = isset( $attributes['tableStyle'] ) ? $attributes['tableStyle'] : 'default';
    
    if ( empty( $table_data ) ) {
        return '<p>' . __( 'No table data available.', 'dthree-gutenberg' ) . '</p>';
    }
    
    // Build CSS classes
    $classes = array( 'table' );
    if ( $is_striped ) {
        $classes[] = 'table-striped';
    }
    if ( $is_bordered ) {
        $classes[] = 'table-bordered';
    }
    if ( $is_hoverable ) {
        $classes[] = 'table-hover';
    }
    if ( $table_style !== 'default' ) {
        $classes[] = 'table-' . esc_attr( $table_style );
    }
    if ( $is_sortable ) {
        $classes[] = 'dthree-sortable-table';
    }
    
    $output = '<div class="dthree-data-table-block">';
    
    if ( $is_responsive ) {
        $output .= '<div class="table-responsive">';
    }
    
    $output .= '<table class="' . esc_attr( implode( ' ', $classes ) ) . '">';
    
    // Header row
    if ( $has_header && ! empty( $table_data[0] ) ) {
        $output .= '<thead><tr>';
        foreach ( $table_data[0] as $cell ) {
            $output .= '<th>' . esc_html( $cell );
            if ( $is_sortable ) {
                $output .= '<span class="sort-icon">⇅</span>';
            }
            $output .= '</th>';
        }
        $output .= '</tr></thead>';
        $table_data = array_slice( $table_data, 1 ); // Remove header from body data
    }
    
    // Body rows
    $output .= '<tbody>';
    foreach ( $table_data as $row ) {
        $output .= '<tr>';
        foreach ( $row as $cell ) {
            $output .= '<td>' . esc_html( $cell ) . '</td>';
        }
        $output .= '</tr>';
    }
    $output .= '</tbody>';
    
    $output .= '</table>';
    
    if ( $is_responsive ) {
        $output .= '</div>';
    }
    
    $output .= '</div>';
    
    // Add sortable JavaScript if needed
    if ( $is_sortable ) {
        $output .= "
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tables = document.querySelectorAll('.dthree-sortable-table');
            tables.forEach(table => {
                const headers = table.querySelectorAll('th');
                headers.forEach((header, index) => {
                    header.style.cursor = 'pointer';
                    header.addEventListener('click', function() {
                        sortTable(table, index);
                    });
                });
            });
            
            function sortTable(table, column) {
                const tbody = table.querySelector('tbody');
                const rows = Array.from(tbody.querySelectorAll('tr'));
                const isAscending = table.dataset.sortOrder !== 'asc';
                
                rows.sort((a, b) => {
                    const aValue = a.cells[column].textContent.trim();
                    const bValue = b.cells[column].textContent.trim();
                    
                    // Try numeric comparison first
                    const aNum = parseFloat(aValue.replace(/[^0-9.-]/g, ''));
                    const bNum = parseFloat(bValue.replace(/[^0-9.-]/g, ''));
                    
                    if (!isNaN(aNum) && !isNaN(bNum)) {
                        return isAscending ? aNum - bNum : bNum - aNum;
                    }
                    
                    // Fall back to string comparison
                    return isAscending ? 
                        aValue.localeCompare(bValue) : 
                        bValue.localeCompare(aValue);
                });
                
                rows.forEach(row => tbody.appendChild(row));
                table.dataset.sortOrder = isAscending ? 'asc' : 'desc';
            }
        });
        </script>
        <style>
        .dthree-sortable-table th .sort-icon {
            margin-left: 5px;
            opacity: 0.3;
            font-size: 0.8em;
        }
        .dthree-sortable-table th:hover .sort-icon {
            opacity: 1;
        }
        </style>
        ";
    }
    
    return $output;
}
