(function( $ ) {
	"use strict";

    var NewsxWidgets = {
		init: function() {
            NewsxWidgets.sectionTitleClick();

            NewsxWidgets.handleConditionalLogics();

            NewsxWidgets.responsiveSwitcherClick();

            NewsxWidgets.initSelect2Control();

            NewsxWidgets.initResponsiveNumberControl();

            NewsxWidgets.initVisibilityControl();
            
            NewsxWidgets.initColorPickerControl();
        },

        sectionTitleClick: function() {
            $('.newsx-widget-section-title').on('click', function() {
                $(this).siblings('.newsx-widget-section-title').removeClass('active');
                $(this).addClass('active');
            });
        },

        handleConditionalLogics: function() {
            NewsxWidgets.dynamicConditionalLogic('select', 'test_s', 'title2', '4');
        },

        dynamicConditionalLogic: function(type, parent, child, value, operator = '==') {
            let wrapper = $('.newsx-widget-section-content');

            // on Change
            if ( 'select' === type ) {
                wrapper.find('select[id*="'+ parent +'"]').change(function() {
                    let thisVal = $(this).val(),
                        field = wrapper.find('[id*="'+ child +'"]').closest('.newsx-widget-field');

                    if ( '==' === operator ) {
                        if ( value === thisVal ) {
                            field.show();
                        } else {
                            field.hide();
                        }
                    } else {
                        if ( value === thisVal ) {
                            field.hide();
                        } else {
                            field.show();
                        }
                    }
                });
            }

            // on Load
            NewsxWidgets.staticConditionalLogic(parent, child, value);
        },

        staticConditionalLogic: function(parent, child, value, operator = '==') {
            let wrapper = $('.newsx-widget-section-content'),
                thisVal = wrapper.find('select[id*="'+ parent +'"]').val(),
                field = wrapper.find('[id*="'+ child +'"]').closest('.newsx-widget-field');

                if ( '==' === operator ) {
                    if ( value === thisVal ) {
                        field.show();
                    } else {
                        field.hide();
                    }
                } else {
                    if ( value === thisVal ) {
                        field.hide();
                    } else {
                        field.show();
                    }
                }
        },

        responsiveSwitcherClick: function() {
            $('.newsx-responsive-switcher').on('click', 'li', function() {
                let device = $(this).data('device');

                $('.newsx-responsive-switcher').find('li').removeClass('active');
                $('.newsx-responsive-switcher li[data-device="'+ device +'"]').addClass('active');

                // Switch Preview in Customizer
                if ( $('body').hasClass('wp-customizer') ) {
                    wp.customize.previewedDevice.set( device );
                }

                let field = $(this).closest('.newsx-widget-field');

                field.find('.newsx-responsive-control').removeClass('active');
                field.find('.newsx-responsive-control[data-device="'+ device +'"]').addClass('active');
            });

            // Set active device on load
            if ( $('body').hasClass('wp-customizer') ) {
                wp.customize.previewedDevice.bind( function( newDevice ) {
                    $('.newsx-responsive-switcher').find('li').removeClass('active');
                    $('.newsx-responsive-switcher li[data-device="'+ newDevice +'"]').addClass('active');
                    
                    $('.newsx-responsive-control').removeClass('active');
                    $('.newsx-responsive-control[data-device="'+ newDevice +'"]').addClass('active');
                });
            }
        },

        initSelect2Control: function() {
            $('.newsx-select2').not('.select2-hidden-accessible').each(function() {
                let multiselect = $(this).hasClass('multiselect') ? 0 : 1;

                $(this).select2({
                     multiple: true,
                     maximumSelectionLength: multiselect,
                });
           });
        },

        initResponsiveNumberControl: function() {
            $('.newsx-widget-field-number-responsive').on('change keyup', '.newsx-responsive-control', function() {
                let fields = $(this).parent().find('.newsx-responsive-control'),
                    valueHolder = $(this).parent().find('.newsx-value-holder'),
                    fieldValues = {};
                
                fields.each(function() {
                    let value = $(this).val(),
                        device = $(this).data('device');

                    fieldValues[device] = value;
                });

                valueHolder.val(JSON.stringify(fieldValues));
            });
        },

        initColorPickerControl: function() {
            $('.newsx-color-picker').wpColorPicker({
                change: function(event, ui) {
                    $(this).val(ui.color.toString()).trigger( 'change' );
                }
            });
        },

        initVisibilityControl: function() {
            $('.newsx-widget-field-visibility').on('change', 'input', function() {
                $(this).closest('label').toggleClass('checked');
            });
        }
    };

    // Init Widgets
    $( document ).on( 'load widget-added widget-updated', NewsxWidgets.init );

})( jQuery );