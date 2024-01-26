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
import { EXAMPLE_POST_TYPE, EXAMPLE_CPT_EXAMPLE_META_KEY } from '../../../../shared/constant';
import MetaTextControlInput from '../components/MetaTextControlInput';

const ExampleCptExampleMeta = ({ postType, postMeta, setPostMeta }) => {
	if (postType !== EXAMPLE_POST_TYPE) return null; // Will only render component for post type 'rv'

	return (
		<PluginDocumentSettingPanel
			title={__('Example CPT Extra Meta', 'rareview-theme')}
			icon="edit"
			initialOpen="true"
		>
			<MetaTextControlInput
				metaKey={EXAMPLE_CPT_EXAMPLE_META_KEY}
				label={__('Example meta', 'rareview-theme')}
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
])(ExampleCptExampleMeta);
