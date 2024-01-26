/**
 * WordPress dependencies
 */
import { CheckboxControl, PanelRow } from '@wordpress/components';

/**
 * Create the input for managing a checkbox control
 *
 * @param {object} Props React props.
 * @param {string} Props.metaKey The meta key.
 * @param {string} Props.label The control label.
 * @param {object} Props.postMeta The Post meta.
 * @param {Function} Props.setPostMeta The function to set post meta.
 *
 * @returns {JSX.Element} The component.
 */
const MetaCheckboxControlInput = ({ metaKey, label, postMeta, setPostMeta }) => {
	return (
		Object.prototype.hasOwnProperty.call(postMeta, metaKey) && (
			<PanelRow>
				<CheckboxControl
					checked={postMeta[metaKey] ? Boolean(postMeta[metaKey]) : false}
					onChange={(value) =>
						setPostMeta({
							[metaKey]: value,
						})
					}
					label={label}
				/>
			</PanelRow>
		)
	);
};

export default MetaCheckboxControlInput;
