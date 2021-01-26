(function () {
    const { __ } = wp.i18n
    const { registerBlockType } = wp.blocks;
    const { InnerBlocks } = wp.blockEditor;
    const { createElement: el } = wp.element;

    registerBlockType('almighty-services-cpt/prices-columns', {
        title: __('Prices columns', 'almighty-services-cpt'),
        description: __('Render the prices of the service as columns', 'almighty-services-cpt'),
        icon: 'money',
        category: 'widgets',
        attributes: {},

        edit: () => {
            const ALLOWED_BLOCKS = ['core/heading', 'core/paragraph', 'core/columns', 'core/column'];
            const TEMPLATE = [
                ['core/columns', {}, buildPricingColumns(4)]
            ];

            function buildPricingColumns(qty) {
                let result = [];

                for (let i = 1; i <= qty; i++) {
                    result.push(['core/column', {
                        className: 'column'
                    }, [
                            ['core/heading', {
                                placeholder: `Título ${i}`,
                                level: 3
                            }],
                            ['core/paragraph', {
                                placeholder: `Descripción ${i}`,
                            }],
                            ['core/paragraph', {
                                placeholder: `Precio ${i}`,
                            }]
                        ]]);
                }

                return result;
            }

            return (
                el('div', {}, [
                    el(InnerBlocks, {
                        allowedBlocks: ALLOWED_BLOCKS,
                        template: TEMPLATE,
                        templateInsertUpdatesSelection: true,
                        templateLock: 'all'
                    })
                ])
            )
        },

        save: () => el(InnerBlocks.Content),
    })
})();


