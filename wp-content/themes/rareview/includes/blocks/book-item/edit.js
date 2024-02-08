/**
 * WordPress dependencies
 */
import { useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import FeatureImage from './FeaturedImage';

const edit = ({ attributes }) => {
	// eslint-disable-next-line react-hooks/rules-of-hooks
	const blockProps = useBlockProps({ className: 'rv-book-block' });

	const { id } = attributes;

	// eslint-disable-next-line react-hooks/rules-of-hooks
	const post = useSelect(
		(select) => {
			// Use getEntityRecord to get the post. Make sure the post type has 'show_in_rest' set to true for this to work.
			const { getEntityRecord } = select('core');
			const post = getEntityRecord('postType', 'book', id);
			return post;
		},
		[id],
	);

	if (!post) {
		return <p>Loading...</p>;
	}
	return (
		<li {...blockProps} key={id}>
			<FeatureImage className="rv-book-block__featured-image" imageId={post.featured_media} />
			<div className="rv-book-block__meta">
				<p className="rv-book-block__title">{post.title.raw}</p>
				<p className="rv-book-block__author-name">{post.meta._rareview_book_author_name}</p>
				<p className="rv-book-block__excerpt">{post.excerpt.raw}</p>
			</div>
		</li>
	);
};
export default edit;
