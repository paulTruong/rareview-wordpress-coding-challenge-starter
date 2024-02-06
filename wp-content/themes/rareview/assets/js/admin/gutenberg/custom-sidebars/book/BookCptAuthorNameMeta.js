/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { compose } from '@wordpress/compose';
import { withSelect, withDispatch } from '@wordpress/data';
import { PluginDocumentSettingPanel } from '@wordpress/edit-post';

/**
 * Internal dependencies
 */
import { BOOK_POST_TYPE, BOOK_AUTHOR_NAME_META_KEY } from '../../../../shared/constant';
import MetaTextControlInput from '../components/MetaTextControlInput';

const BookCptAuthorNameMeta = ({ postType, postMeta, setPostMeta }) => {
	if (postType !== BOOK_POST_TYPE) return null; // Will only render component for post type 'book'

	return (
		<PluginDocumentSettingPanel title={__('Custom Book Fields', 'rareview-theme')}>
			<MetaTextControlInput
				metaKey={BOOK_AUTHOR_NAME_META_KEY}
				label={__('Author Name', 'rareview-theme')}
				postMeta={postMeta}
				setPostMeta={setPostMeta}
			/>
		</PluginDocumentSettingPanel>
	);
};

export default compose([
	withSelect((select) => {
		return {
			postMeta: select('core/editor').getEditedPostAttribute('meta'),
			postType: select('core/editor').getCurrentPostType(),
		};
	}),
	withDispatch((dispatch) => {
		return {
			setPostMeta(newMeta) {
				dispatch('core/editor').editPost({ meta: newMeta });
			},
		};
	}),
])(BookCptAuthorNameMeta);
