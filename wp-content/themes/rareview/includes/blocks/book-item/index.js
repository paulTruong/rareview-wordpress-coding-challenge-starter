/**
 * WordPress dependencies
 */
import { registerBlockType } from '@wordpress/blocks';
/**
 * Internal dependencies
 */
import edit from './edit';
import save from './save';
import block from './block.json';

/**
 * Only Register block if post type is 'post'
 */
registerBlockType(block, {
	edit,
	save,
});
