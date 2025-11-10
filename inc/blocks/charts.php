<?php
/**
 * Charts Block
 *
 * @package DThree_Gutenberg
 */

// Prevent direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Register Charts Block
 */
function dthree_register_charts_block() {
    register_block_type( 'dthree/charts', array(
        'api_version' => 2,
        'title'       => __( 'Charts', 'dthree-gutenberg' ),
        'description' => __( 'Create interactive charts and graphs - bar, line, pie, doughnut, and more.', 'dthree-gutenberg' ),
        'category'    => 'dthree-blocks',
        'icon'        => 'chart-bar',
        'keywords'    => array( 'chart', 'graph', 'data', 'statistics', 'analytics' ),
        'supports'    => array(
            'align' => array( 'wide', 'full' ),
        ),
        'attributes'  => array(
            'chartType'   => array(
                'type'    => 'string',
                'default' => 'bar',
            ),
            'chartTitle'  => array(
                'type'    => 'string',
                'default' => 'Chart Title',
            ),
            'labels'      => array(
                'type'    => 'array',
                'default' => array( 'January', 'February', 'March', 'April', 'May', 'June' ),
            ),
            'datasets'    => array(
                'type'    => 'array',
                'default' => array(
                    array(
                        'label' => 'Sales 2024',
                        'data'  => array( 65, 59, 80, 81, 56, 55 ),
                        'backgroundColor' => '#2563eb',
                    ),
                ),
            ),
            'showLegend'  => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'showGrid'    => array(
                'type'    => 'boolean',
                'default' => true,
            ),
            'height'      => array(
                'type'    => 'number',
                'default' => 400,
            ),
        ),
        'render_callback' => 'dthree_render_charts_block',
    ) );
}
add_action( 'init', 'dthree_register_charts_block' );

/**
 * Render Charts Block
 */
function dthree_render_charts_block( $attributes ) {
    $chart_type  = isset( $attributes['chartType'] ) ? $attributes['chartType'] : 'bar';
    $chart_title = isset( $attributes['chartTitle'] ) ? $attributes['chartTitle'] : 'Chart Title';
    $labels      = isset( $attributes['labels'] ) ? $attributes['labels'] : array();
    $datasets    = isset( $attributes['datasets'] ) ? $attributes['datasets'] : array();
    $show_legend = isset( $attributes['showLegend'] ) ? $attributes['showLegend'] : true;
    $show_grid   = isset( $attributes['showGrid'] ) ? $attributes['showGrid'] : true;
    $height      = isset( $attributes['height'] ) ? $attributes['height'] : 400;
    
    $chart_id = 'dthree-chart-' . uniqid();
    
    // Prepare chart data
    $chart_data = array(
        'type' => $chart_type,
        'data' => array(
            'labels'   => $labels,
            'datasets' => array(),
        ),
        'options' => array(
            'responsive'          => true,
            'maintainAspectRatio' => false,
            'plugins'             => array(
                'legend' => array(
                    'display' => $show_legend,
                ),
                'title' => array(
                    'display' => ! empty( $chart_title ),
                    'text'    => $chart_title,
                ),
            ),
            'scales' => array(),
        ),
    );
    
    // Add datasets with colors
    $colors = array(
        '#2563eb', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6',
        '#ec4899', '#06b6d4', '#84cc16', '#f97316', '#6366f1',
    );
    
    foreach ( $datasets as $index => $dataset ) {
        $color = isset( $dataset['backgroundColor'] ) ? $dataset['backgroundColor'] : $colors[ $index % count( $colors ) ];
        
        $formatted_dataset = array(
            'label'           => isset( $dataset['label'] ) ? $dataset['label'] : 'Dataset ' . ( $index + 1 ),
            'data'            => isset( $dataset['data'] ) ? $dataset['data'] : array(),
            'backgroundColor' => $color,
            'borderColor'     => $color,
            'borderWidth'     => 2,
        );
        
        // Pie and doughnut charts need multiple colors
        if ( in_array( $chart_type, array( 'pie', 'doughnut' ), true ) ) {
            $formatted_dataset['backgroundColor'] = array_slice( $colors, 0, count( $labels ) );
        }
        
        $chart_data['data']['datasets'][] = $formatted_dataset;
    }
    
    // Configure scales based on chart type
    if ( ! in_array( $chart_type, array( 'pie', 'doughnut', 'polarArea' ), true ) ) {
        $chart_data['options']['scales'] = array(
            'y' => array(
                'beginAtZero' => true,
                'grid'        => array(
                    'display' => $show_grid,
                ),
            ),
            'x' => array(
                'grid' => array(
                    'display' => $show_grid,
                ),
            ),
        );
    }
    
    $chart_json = wp_json_encode( $chart_data );
    
    $output = '<div class="dthree-chart-block" style="margin: 20px 0;">';
    $output .= '<div class="chart-container" style="position: relative; height: ' . esc_attr( $height ) . 'px;">';
    $output .= '<canvas id="' . esc_attr( $chart_id ) . '"></canvas>';
    $output .= '</div>';
    $output .= '</div>';
    
    // Enqueue Chart.js from CDN
    wp_enqueue_script(
        'chartjs',
        'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js',
        array(),
        '4.4.0',
        true
    );
    
    // Add inline script to render chart
    $output .= "
    <script>
    (function() {
        function initChart() {
            if (typeof Chart === 'undefined') {
                setTimeout(initChart, 100);
                return;
            }
            
            const ctx = document.getElementById('" . esc_js( $chart_id ) . "');
            if (ctx && !ctx.chartInstance) {
                ctx.chartInstance = new Chart(ctx, " . $chart_json . ");
            }
        }
        
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initChart);
        } else {
            initChart();
        }
    })();
    </script>
    ";
    
    return $output;
}

/**
 * Enqueue Chart.js library
 */
function dthree_enqueue_chartjs() {
    // Only enqueue if we're not in the editor (block editor handles its own scripts)
    if ( ! is_admin() ) {
        wp_enqueue_script(
            'chartjs',
            'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js',
            array(),
            '4.4.0',
            true
        );
    }
}
add_action( 'wp_enqueue_scripts', 'dthree_enqueue_chartjs' );
