(function () {
    const { __ } = wp.i18n
    const { InspectorControls } = wp.blockEditor;
    const { ColorPicker } = wp.components;
    const { createElement: el } = wp.element;

    wp.blocks.registerBlockType('almighty-services-cpt/list-services-as-vinyls', {
        title: __('Services as vinyls', 'almighty-services-cpt'),
        description: __('Renders a list of all the services like a vinyls covers', 'almighty-services-cpt'),
        icon: 'album',
        category: 'common',
        attributes: {
            pickedColor: { type: 'string' }
        },

        edit({ attributes, setAttributes }) {
            const setPickedColor = value => setAttributes({ pickedColor: value });

            return (
                el('div', {},
                    el(wp.serverSideRender, {
                        block: 'almighty-services-cpt/list-services-as-vinyls',
                        attributes: attributes
                    }),
                    el(InspectorControls, {}, [
                        el(ColorPicker, {
                            color: '#f00',
                            onChangeComplete: value => {
                                setPickedColor(value.hex)
                            },
                            disableAlpha: true
                        })
                    ])
                )
            )
        },

        save: () => null
    })
})();