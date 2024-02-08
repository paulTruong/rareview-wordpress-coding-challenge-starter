import { InnerBlocks } from '@wordpress/block-editor';

// Still need to save the inner blocks in order to display them on the front end even though it's dynamic.
const save = () => {
	return <InnerBlocks.Content />;
};
export default save;
