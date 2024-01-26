/**
 * WordPress dependencies
 */
import { TextControl, PanelRow } from '@wordpress/components';

/**
 * Create the input for managing a text control
 *
 * @param {object} Props React props.
 * @param {string} Props.metaKey The meta key.
 * @param {string} Props.label The control label.
 * @param {object} Props.postMeta The Post meta.
 * @param {Function} Props.setPostMeta The function to set post meta.
 *
 * @returns {JSX.Element} The component.
 */
const TextControlPickerInput = ({ metaKey, label, postMeta, setPostMeta }) => {
	return (
		Object.prototype.hasOwnProperty.call(postMeta, metaKey) && (
			<PanelRow>
				<TextControl
					label={label}
					value={postMeta[metaKey] ? postMeta[metaKey] : ''}
					onChange={(value) => setPostMeta({ [metaKey]: value })}
				/>
			</PanelRow>
		)
	);
};

export default TextControlPickerInput;
