/**
 * WordPress dependencies
 */
import { useBlockProps, useInnerBlocksProps } from '@wordpress/block-editor';
import { __ } from '@wordpress/i18n';
import { dispatch } from '@wordpress/data';
import { createBlock } from '@wordpress/blocks';

/**
 * Other dependencies
 */
import { ContentSearch } from '@10up/block-components';

const edit = (props) => {
	// eslint-disable-next-line react-hooks/rules-of-hooks
	const blockProps = useBlockProps({
		className: 'rv-book-listing-block',
	});

	// InnerBlocks will be used to add the book items. This will give us WordPress's drag and drop functionality to reorder the books.
	// We only allow the book-item block to be added to this block.
	// book-item has the inserter disabled so this will also remove the inserter from this block.
	// eslint-disable-next-line react-hooks/rules-of-hooks
	const { children, ...InnerBlocksProps } = useInnerBlocksProps(
		{ className: 'rv-book-listing-block__list' },
		{
			orientation: 'horizontal',
			allowedBlocks: ['rareview/book-item'],
		},
	);

	// Get the clientId of this block
	const { clientId } = props;
	const insertBook = (book) => {
		// Create the book-item block
		const block = createBlock('rareview/book-item', {
			id: book.id,
		});

		// Insert it into this listing. WP is smart enough to put it into the InnerBlocks area.
		dispatch('core/block-editor').insertBlock(block, undefined, clientId);
	};

	return (
		<section {...blockProps}>
			<ContentSearch
				onSelectItem={(item) => {
					insertBook(item);
				}}
				mode="post"
				label={__(`Search for a book to add to the listing.`)}
				contentTypes={['book']}
			/>
			<ul {...InnerBlocksProps}>{children}</ul>
		</section>
	);
};
export default edit;
