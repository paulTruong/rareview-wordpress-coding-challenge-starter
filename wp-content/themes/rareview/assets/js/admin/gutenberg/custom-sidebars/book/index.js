/**
 * Internal dependencies
 */
import BookCptAuthorNameMeta from './BookCptAuthorNameMeta';

const { registerPlugin } = wp.plugins;

registerPlugin('rareview-book-cpt-author-name-meta-sidebar', {
	render() {
		return <BookCptAuthorNameMeta />;
	},
});
