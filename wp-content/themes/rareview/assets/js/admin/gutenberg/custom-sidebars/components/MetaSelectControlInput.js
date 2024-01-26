/**
 * WordPress dependencies
 */
import { SelectControl, PanelRow } from '@wordpress/components';

/**
 * Create the input for managing a select control.
 *
 * @param {object} Props React props.
 * @param {string} Props.metaKey The meta key.
 * @param {string} Props.label The control label.
 * @param {string|number} Props.selectedValue The control selected value.
 * @param {object} Props.options The select options.
 * @param {object} Props.postMeta The Post meta.
 * @param {Function} Props.setPostMeta The function to set post meta.
 *
 * @returns {JSX.Element} The component.
 */
const MetaSelectControlInput = ({
	metaKey,
	label,
	selectedValue,
	options,
	postMeta,
	setPostMeta,
}) => {
	return (
		Object.prototype.hasOwnProperty.call(postMeta, metaKey) && (
			<PanelRow>
				<SelectControl
					label={label}
					value={selectedValue}
					onChange={(value) => setPostMeta({ [metaKey]: value })}
					options={options}
				/>
			</PanelRow>
		)
	);
};

export default MetaSelectControlInput;
