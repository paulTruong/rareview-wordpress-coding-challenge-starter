/**
 * WordPress dependencies
 */
import { useSelect } from '@wordpress/data';

/**
 * A Component to display the featured image.
 *
 * @param {object} Props React props.
 * @param {string} Props.imageId The image id.
 * @param {string} Props.className The class name.
 *
 * @returns {JSX.Element} The component.
 */
const FeaturedImage = ({ className, imageId }) => {
	// eslint-disable-next-line react-hooks/rules-of-hooks
	const featuredImage = useSelect(
		(select) => {
			const { getMedia } = select('core');
			return getMedia(imageId);
		},
		[imageId],
	);

	if (!featuredImage) {
		return <p>No featured image</p>;
	}

	return (
		<img className={className} src={featuredImage.source_url} alt={featuredImage.alt_text} />
	);
};

export default FeaturedImage;
