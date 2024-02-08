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

registerBlockType(block, {
	edit,
	save,
});
