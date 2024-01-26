/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { RichText, useBlockProps } from '@wordpress/block-editor';

const edit = ({ attributes, setAttributes }) => {
	// eslint-disable-next-line react-hooks/rules-of-hooks
	const blockProps = useBlockProps({
		className: 'example-block-block',
	});

	const { title } = attributes;

	return (
		<section {...blockProps}>
			<RichText
				className="example-block-block__title"
				tagName="h2"
				value={title}
				allowedFormats={['core/bold']}
				onChange={(title) => setAttributes({ title })}
				placeholder={__('Enter a title', 'rareview-theme')}
			/>
			<br />
		</section>
	);
};
export default edit;
