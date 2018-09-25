(function ($) {

	"use strict";

	window.themeFront = {

		/**
		 Constructor
		 **/
		initialize: function () {

			var self = this;

			$(document).ready(function () {
				self.build();
				self.events();
			});

		},
		/**
		 Build page elements, plugins init
		 **/
		build: function () {

			this.setupHeader();
			this.loadGoogleFonts();

		},
		/**
		 Set page events
		 **/
		events: function () {

            function getQueryParams(qs) {
                qs = qs.split('+').join(' ');

                var params = [],
                    tokens,
                    re = /([a-z_]+)=([^&]*)/g;

                while (tokens = re.exec(qs)) {
                    params[decodeURIComponent(tokens[1])] = decodeURIComponent(tokens[2]);
                }
                return params;
            }


            $('.btn-filter').on('click', function() {
                var params = getQueryParams(window.location.href);
                params['paging'] = 1;

                $('.form-control').each(function() {
                    if ($(this).val() != '') {
                        params[$(this).attr('id')] = $(this).val();
                    } else {
                        if (params[$(this).attr('id')]!='undefined') delete params[$(this).attr('id')];
                    }
                });

                var param = [];
                Object.keys(params).forEach(function(key) {
                    param.push({name: key, value:params[key]});
                });

                window.location.href = '?'+jQuery.param(param);
            });

            $('.btn-clear').on('click', function() {
                $('.form-control').each(function() {
                    $(this).val('');
                });
            });

            $('body').on('click', '.tabs .tab:not(.active)', function() {

                $('.tab-content').hide();
                $('.tabs .tab').removeClass('active');

                var tab = $(this).data('tab');

                $(this).addClass('active');
                $('.tab-content[data-tab='+tab+']').show();

            });

            // Charts
            console.log(document.getElementById('chartjs'));
            var ctx = document.getElementById('chartjs').getContext('2d');
            var jsChart = new Chart(ctx, {
                type:"horizontalBar",
                data:{
                    labels:["January","February","March","April","May","June","July"],
                    datasets:[{
                        label:"My First Dataset",
                        data:[65,59,80,81,56,55,40],
                        fill:false,
                        backgroundColor:[
                            "rgba(255, 99, 132, 0.7)",
                            "rgba(255, 159, 64, 0.7)",
                            "rgba(255, 205, 86, 0.7)",
                            "rgba(75, 192, 192, 0.7)",
                            "rgba(54, 162, 235, 0.7)",
                            "rgba(153, 102, 255, 0.7)",
                            "rgba(201, 203, 207, 0.7)"
                        ],
                        borderColor:[
                            "rgb(255, 99, 132)",
                            "rgb(255, 159, 64)",
                            "rgb(255, 205, 86)",
                            "rgb(75, 192, 192)",
                            "rgb(54, 162, 235)",
                            "rgb(153, 102, 255)",
                            "rgb(201, 203, 207)"
                        ],
                        borderWidth:1
                    }]
                },
                options:{
                    scales:{
                        xAxes:[{
                            ticks:{
                                beginAtZero:true
                            }
                        }],
                        yAxes: [{
                            display: true,
                            //barPercentage: 0.62,
                            //categoryPercentage: 0.2,
                            barThickness: 15
                        }]
                    }
                }
            });


		},

		/**
		 * Setup Header
		 **/
		setupHeader: function() {
            
			
		},

		/**
		 * Load Google Fonts
		 **/
		loadGoogleFonts: function () {

			WebFont.load({google: {families: ["Montserrat:300,400,500,600,700,800"]}});

		},

		/** Check for mobile device **/
		isMobile: function () {
			return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
		},
		stringToBoolean: function (string) {

			switch (string) {
				case "true":
				case "yes":
				case "1":
					return true;
				case "false":
				case "no":
				case "0":
				case null:
				case '':
					return false;
				default:
					return Boolean(string);
			}
		},
		/** Check email address **/
		isValidEmailAddress: function (emailAddress) {
			var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
			return pattern.test(emailAddress);
		}

	}

	window.themeFront.initialize();

})(window.jQuery);
