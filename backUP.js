jQuery(function ($) {
    /**
     * Accordion
     */
    $(document).ready(function ($) {
        $('.accordion-toggle').click(function () {
            const _this = $(this);

            //Expand or collapse this panel
            _this.next().slideToggle('fast');
            _this
                .toggleClass('accordion-open')
                .find('.accordion-toggle__icon')
                .toggleClass('active');

            //Hide the other panels
            //$(".accordion-content").not(_this.next()).slideUp('fast').sibling('.accordion-toggle__icon').removeClass('active');
        });

        /**
         * Stop sample add to cart without samples
         */
        $('body.category_samples .nm-simple-add-to-cart-button').prop(
            'disabled',
            true,
        );
    });

    function setPrice(price) {
        $('.swatch-preview .product-price-value').text(price.toFixed(2));
    }

    // this sets the hidden variation drop down fields
    function setVariation(type, mode = 'set') {
        const variation = $(`.sod_option[data-value="${type}"]`).not(
            '.sod_option_custom',
        );

        if (mode === 'set') {
            //$(variation).click();
            $(`select option[value="${type}"]`)
                .prop('selected', 'selected')
                .change();
        } else {
            //$(variation).siblings('.sod_option:first').addClass('toggle').click();
            $(`select option[value="${type}"]`)
                .removeAttr('selected')
                .change();
        }
    }

    function addOptionToPreview(selector, value, mode = 'set') {
        if (mode === 'set') {
            $(`.swatch-preview .${selector}`).text(value);
        } else {
            $(`.swatch-preview .${selector}`).text('');
        }
    }

    // make this more robust
    function showSwatch(evt) {
        const parent = $(evt.target).parent();
        const mode = $(parent).hasClass('active') ? 'remove' : 'set';

        // for fabrics
        const fabricName = $(evt.target).data('fabric_name');

        const fabricTypeSlug = $(evt.target).data('type_slug');
        const fabricClassSlug = $(evt.target).data('class_slug');

        fabricClassSlug && setVariation(fabricClassSlug, mode);

        // show the preview
        if (fabricName) {
            fabricName && addOptionToPreview('fabric-name', fabricName, mode);

            if (mode === 'set') {
                $('.swatch-preview img')
                    .attr('src', parent.attr('data-src_full'))
                    .fadeIn();
                $('.non-swatch-preview img')
                    .attr('src', parent.attr('data-src_full'))
                    .fadeIn();
            } else {
                $('.swatch-preview img').fadeOut();
                $('.non-swatch-preview img').fadeOut();
            }

            $('.swatch-preview').addClass('is-active');
        }

        // for all others
        const attributeSlug = evt.target.dataset.attribute_slug;

        if (attributeSlug) {
            const attribute = evt.target.dataset.attribute;
            const attributeName = evt.target.dataset.attribute_name;
            setVariation(attributeSlug, mode);
            addOptionToPreview(attribute, attributeName, mode);

            // set the woocommerce gallery thumb

            const imgFull = parent.attr('data-src_full');

            if (mode === 'set') {
                $('.non-swatch-preview img')
                    .attr('src', imgFull)
                    .fadeIn();
            } else {
                $('.non-swatch-preview img').fadeOut();
            }

            $('.non-swatch-preview').addClass('is-active');
        }

        // make the other swatch inactive
        $(parent)
            .siblings('.single-swatch')
            .removeClass('active');
        // add active to this swatch
        $(parent).toggleClass('active');
    }

    // Shows and hides the custom dropdown
    function sodCustomSelect(obj) {
        const wrapper = $(obj).find('.sod_list_wrapper');
        wrapper.toggleClass('is-active');
        wrapper.fadeToggle();
    }

    // Function to set the filters
    function checkSwatches() {
        const currentFilters = $('.sod_option_custom.active');

        const thisClasses = $('.single-sample-swatch');

        const collectionItem = $('.collection-item');


        if (currentFilters.length >= 1 || thisClasses.hasClass('swatch-is-hidden')) {
            console.log('more that >= 1');
            collectionItem.addClass("hiddenMe");
            console.log('tried to add class');
        }




        $('.single-swatch-img')
            .parent()
            .addClass('swatch-is-hidden')




        if (currentFilters.length === 2) {
            const typeOne = $(currentFilters[0]).attr('data-type');
            const filterOne = $(currentFilters[0]).attr('data-value');
            const typeTwo = $(currentFilters[1]).attr('data-type');
            const filterTwo = $(currentFilters[1]).attr('data-value');

            $(
                `.single-swatch-img[data-${typeOne}_slug="${filterOne}"][data-${typeTwo}_slug="${filterTwo}"]`,
            )
                .parent()
                .removeClass('swatch-is-hidden')
                .addClass('swatch-is-filtered');
            //$('.single-swatch-img').not( `[data-${typeOne}_slug="${filterOne}"], [data-${typeTwo}_slug="${filterTwo}"]` ).parent().addClass('i-will-be-hidden');
        } else {
            const type = currentFilters.attr('data-type');
            const filter = currentFilters.attr('data-value');

            // i.e. data-color_slug="charcoal-black"
            $(`.single-swatch-img[data-${type}_slug="${filter}"]`)
                .parent()
                .removeClass('swatch-is-hidden')
                .addClass('swatch-is-filtered');
            //$(`.single-swatch-img[data-${type}_slug!="${filter}"]`).parent().removeClass('swatch-is-hidden');
        }
    }

    function resetSwatches() {
        const currentFilters = $('.sod_option_custom.active');

        console.log(currentFilters);

        if (currentFilters.length < 1) {
            // $('.collection-item').removeClass("hiddenMe");
            // console.log('less than one!');
            $('.single-swatch, .single-sample-swatch')
                .removeClass('swatch-is-hidden')
                .removeClass('swatch-is-filtered');
        } else {
            const type = currentFilters.attr('data-type');
            const filter = currentFilters.attr('data-value');
            $(`.single-swatch-img[data-${type}_slug="${filter}"]`)
                .parent()
                .removeClass('swatch-is-hidden')
                .addClass('swatch-is-filtered');
        }
    }

    function showEnquiryForm() {
        // empty object
        const selectedOptons = {};

        $('.sod_option.selected').each((index, selected) => {
            const option = $(selected)
                .parent()
                .parent()
                .parent()
                .parent()
                .prev()
                .children()
                .text();
            const value = $(selected).attr('title');
            selectedOptons[option] = value;
        });

        $('#input_10_9').val(JSON.stringify(selectedOptons));

        $.magnificPopup.open({
            mainClass: 'nm-login-popup nm-mfp-fade-in',
            alignTop: true,
            closeMarkup: '<a class="mfp-close nm-font nm-font-close2"></a>',
            removalDelay: 180,
            items: {
                src: '#nm-enquiry-popup-wrap',
                type: 'inline',
            },
            callbacks: {
                close: function () {
                    // Make sure the login form is displayed when the modal is re-opened
                    $('#nm-login-wrap').addClass('inline fade-in slide-up');
                    $('#nm-register-wrap').removeClass('inline fade-in slide-up');
                },
            },
        });
    }

    window.onload = function () {
        const swatches = $('.single-swatch');

        swatches.click(evt => {
            showSwatch(evt);
        });

        // Array.from(swatches).forEach(link => {
        // 	link.addEventListener('click', evt => {

        // 	});
        // });

        // Filters
        const sod = $('.sod_custom');

        sod.click(evt => {
            sodCustomSelect(evt.currentTarget);
        });

        $('.single_variation_wrap').on('show_variation', function (
            event,
            variation,
        ) {
            // Fired when the user selects all the required dropdowns / attributes
            // and a final variation is selected / shown
            setPrice(variation.display_price);
        });

        // Our filters on click
        const sod_option = $('.sod_option_custom');

        sod_option.click(evt => {
            const option = $(evt.currentTarget);

            // make active
            option.toggleClass('active');

            // remove active class from parents
            option.siblings().removeClass('active');

            // add the label to the parent
            option
                .parent()
                .parent()
                .siblings('.sod_label_custom')
                .text(option.attr('title'));

            checkSwatches();
        });

        // Reset filters
        const sod_option_reset = $('.sod_option_reset');

        sod_option_reset.click(evt => {
            const option = $(evt.currentTarget);

            // make active
            option.toggleClass('active');

            // remove active class from parents
            option.siblings().removeClass('active');

            // add the label to the parent
            option
                .parent()
                .parent()
                .siblings('.sod_label_custom')
                .text(option.attr('title'));

            resetSwatches();
        });

        $('#nm-enquiry-popup-trigger').click(() => {
            showEnquiryForm();
        });

        $('.swatch-preview-button').click(evt => {
            const _this = $(evt.currentTarget);

            if (_this.hasClass('swatch-preview-add_to_cart')) {
                $('.single_add_to_cart_button').click();
            } else {
                showEnquiryForm();
            }
        });

        $('.preview-close').click(evt => {
            const _this = $(evt.currentTarget);
            $('.attribute-preview').removeClass('is-active');
        });

        setSelectedAttributesOnLoad();

        // fabric samples
        const samples = document.querySelectorAll('.single-sample-swatch');

        Array.from(samples).forEach(link => {
            link.addEventListener('click', evt => {
                showSample(evt);
            });
        });
    };

    function setSelectedAttributesOnLoad() {
        // loop through all of the preselected values and then map to the swatch
        $('.sod_option.selected').each((index, selected) => {
            const value = $(selected).attr('data-value');

            $(`.single-swatch-img[data-attribute_slug="${value}"]`)
                .parent()
                .addClass('active');
        });
    }

    function showSample(evt) {
        const parent = $(evt.target).parent();
        const mode = $(parent).hasClass('active') ? 'remove' : 'set';
        const imgFull = $(parent).attr('data-src_full');

        if (mode === 'set') {
            $('.non-swatch-preview img')
                .attr('src', imgFull)
                .fadeIn();
        } else {
            $('.non-swatch-preview img').fadeOut();
        }

        $('.non-swatch-preview').addClass('is-active');

        // first check if need to remove
        if ($(parent).hasClass('active')) {
            $(parent).removeClass('active');

            const samples = $('.single-sample-swatch.active');

            if (samples.length === 0) {
                $('body.category_samples .nm-simple-add-to-cart-button').prop(
                    'disabled',
                    true,
                );
            }

            return false;
        }

        // 1. get all of the swatches
        const samples = $('.single-sample-swatch.active');

        // add active to this swatch
        if (samples.length < 5) {
            $(parent).toggleClass('active');

            let samplesArr = [];

            samplesArr.push($(evt.target).attr('data-fabric_name'));

            $.each(samples, (i, sample) => {
                samplesArr.push(
                    $(sample)
                        .children('img')
                        .attr('data-fabric_name'),
                );
            });

            $('#swatch-samples').val(samplesArr.join(', ').toString());

            $('body.category_samples .nm-simple-add-to-cart-button').prop(
                'disabled',
                false,
            );
        } else {
            alert('Please select up to 5 samples');
        }
    }
});
