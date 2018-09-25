(function ($) {

    "use strict";

    window.Charts = {

        init: function( config ) {
            this.config = config;

            this.type = '';

            this.canvas_id = config.canvas_id;
            this.$canvas = $('#'+this.canvas_id);

            this.$legend = this.$contaner.find('.legend');
            this.$legend_info = this.$contaner.find('.legend-info');

            this.chartJSConfig = {};
            this.ctx = {};
            this.jsChart = {};

            return this;
        },

        events: function() {
        },

        legendCallback: function(chart) {
            var text = [];
            text.push('<ul>');

            var data = chart.data;
            var datasets = data.datasets;
            var labels = data.labels;

            if (datasets.length) {
                for (var i = 0; i < datasets[0].data.length; ++i) {
                    text.push('<li '+(i==0 ? 'class="active"':'')+' data-index="'+i+'"><span style="background-color:' + datasets[0].backgroundColor[i] + '"></span>');
                    if (labels[i]) {
                        text.push(labels[i]);
                    }
                    text.push('</li>');
                }
            }
            text.push('</ul>');
            return text.join('');
        },


        drawChart: function( ) {

            // Create labels
            if (!this.config.data.labels) {
                this.config.data.labels = [];
                for (var i = 0; i < this.config.data.datasets[0].data.length; i++) {
                    var label = this.config.data.datasets[0].labelMask;
                    label = label.replace(/#data_text#/gi, this.config.data.datasets[0].data_text[i]);
                    label = label.replace(/#data#/gi, this.config.data.datasets[0].data[i]);
                    this.config.data.labels.push(label);
                }
            }

            this.chartJSConfig.type = this.config.type;
            this.chartJSConfig.data = this.config.data;
            this.chartJSConfig.options = this.config.options;


            this.ctx = document.getElementById(this.canvas_id).getContext('2d');
            this.jsChart = new Chart(this.ctx, this.chartJSConfig);

            if( $('#'+this.container_id+' .legend').is(':visible')) {
                this.legend_html = this.legendCallback(this.jsChart);
                this.$legend.html(this.legend_html);
            }

            this.events();

            $('#'+this.container_id+' li.active').click();
        },

    }

    $(document).ready(function () {
        var charts = [];

        /*
        // Chart JS
        charts_config.forEach(function (config, index) {
            charts[index] = Object.create(ffcChart);
            charts[index].init(config);
            charts[index].drawChart();
        });
        */


    });

})(window.jQuery);
