import classNames from 'classnames';

const { addFilter } = wp.hooks;
const { ToolbarGroup, ToolbarButton } = wp.components;
const { Fragment } = wp.element;
const { BlockControls } = wp.editor;
const { createHigherOrderComponent } = wp.compose;

const BLOCKS_TO_CONSIDER = ['core/group'];

const innerContentAlign = (settings, name) => {
	if (!BLOCKS_TO_CONSIDER.includes(name)) {
		return settings;
	}

	if (typeof settings.attributes !== 'undefined') {
		settings.attributes = Object.assign(settings.attributes, {
			innerContentAlign: {
				type: 'boolean',
				default: false,
			},
		});
	}

	return settings;
};

addFilter('blocks.registerBlockType', 'rareview/innerContentAlign', innerContentAlign);

const innerContentAlignSelect = createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		const { attributes, setAttributes, name } = props;
		const { innerContentAlign } = attributes;

		if (!BLOCKS_TO_CONSIDER.includes(name)) {
			return <BlockEdit {...props} />;
		}

		return (
			<Fragment>
				<BlockControls>
					<ToolbarGroup>
						<ToolbarButton
							icon="editor-aligncenter"
							label="Center Inner Content"
							isActive={innerContentAlign === true}
							onClick={() => {
								if (innerContentAlign === true) {
									setAttributes({ innerContentAlign: false });
								} else {
									setAttributes({ innerContentAlign: true });
								}
							}}
						/>
					</ToolbarGroup>
				</BlockControls>
				<BlockEdit {...props} />
			</Fragment>
		);
	};
}, 'innerContentAlignSelect');

addFilter('editor.BlockEdit', 'rareview/innerContentAlignSelect', innerContentAlignSelect);

/*
 * Add / remove CSS class in editor.
 * */
const innerContentAlignEditorClass = createHigherOrderComponent((BlockListBlock) => {
	return (props) => {
		const { attributes, name } = props;
		const { innerContentAlign } = attributes;

		if (!BLOCKS_TO_CONSIDER.includes(name)) {
			return <BlockListBlock {...props} />;
		}

		if (innerContentAlign === true) {
			return <BlockListBlock {...props} className="rv-center-inner-content" />;
		}
		return <BlockListBlock {...props} />;
	};
}, 'innerContentAlignEditorClass');

wp.hooks.addFilter(
	'editor.BlockListBlock',
	'rareview/with-toolbar-button-prop',
	innerContentAlignEditorClass,
);

/*
 * Add / remove CSS class in frontend.
 * */
function innerContentAlignFrontendClass(extraProps, blockType, attributes) {
	const { innerContentAlign } = attributes;

	if (innerContentAlign === true) {
		extraProps.className = classNames(extraProps.className, 'rv-center-inner-content');
	}

	return extraProps;
}

addFilter(
	'blocks.getSaveContent.extraProps',
	'rareview/innerContentAlignFrontendClass',
	innerContentAlignFrontendClass,
);
