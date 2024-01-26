/**
 * WordPress dependencies
 */
import { useRef, useState } from '@wordpress/element';
import { Button, DateTimePicker, Dropdown, PanelRow } from '@wordpress/components';

/**
 * External dependencies
 */
// eslint-disable-next-line import/no-extraneous-dependencies
const timezone = require('dayjs/plugin/timezone');
// eslint-disable-next-line import/no-extraneous-dependencies
const utc = require('dayjs/plugin/utc');
// eslint-disable-next-line import/no-extraneous-dependencies
const dayjs = require('dayjs');

dayjs.extend(utc);
dayjs.extend(timezone);

const setDate = (dateValue) => {
	return dateValue ? dayjs(dateValue) : dayjs();
};

/**
 * Create the input for managing a date time meta.
 *
 * @param {object} Props React props.
 * @param {string} Props.metaKey The meta key.
 * @param {string} Props.label The control label.
 * @param {object} Props.postMeta The Post meta.
 * @param {Function} Props.setPostMeta The function to set post meta.
 *
 * @returns {JSX.Element} The component.
 */
const MetaDateTimePickerInput = ({ metaKey, label, postMeta, setPostMeta }) => {
	const [dateValue, setDateValue] = useState(setDate(postMeta[metaKey] ?? 0));

	const ref = useRef();

	/**
	 * Date Change handler.
	 *
	 * @param {number} newDateValue New date value.
	 */
	const onChangeDate = (newDateValue) => {
		const newDate = dayjs(newDateValue ?? new Date()).add(
			Math.abs(new Date().getTimezoneOffset()),
			'minute',
		);
		setDateValue(setDate(newDate.format()));
		setPostMeta({ [metaKey]: newDate.utc().valueOf() });
		const { ownerDocument } = ref.current;
		ownerDocument.activeElement.blur();
	};

	return (
		Object.prototype.hasOwnProperty.call(postMeta, metaKey) && (
			<PanelRow>
				<div className="rareview-date__label">{label}</div>

				<Dropdown
					className="rareview-date__dropdown"
					contentClassName="rareview-date__dropdown-content"
					position="bottom left"
					renderToggle={({ onToggle, isOpen }) => (
						<Button
							className="rareview-date__dropdown-toggle is-tertiary"
							onClick={onToggle}
							aria-expanded={isOpen}
							variant="tertiary"
						>
							{dateValue.utc().format('MM/DD/YYYY HH:mm UTC')}
						</Button>
					)}
					renderContent={() => (
						<DateTimePicker
							currentDate={dateValue
								.subtract(Math.abs(new Date().getTimezoneOffset()), 'minute')
								.toDate()}
							onChange={onChangeDate}
							ref={ref}
						/>
					)}
				/>
			</PanelRow>
		)
	);
};

export default MetaDateTimePickerInput;
