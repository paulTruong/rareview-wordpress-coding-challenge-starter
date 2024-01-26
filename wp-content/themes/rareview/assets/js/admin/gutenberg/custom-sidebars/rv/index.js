/**
 * Internal dependencies
 */
import ExampleCptExampleMeta from './ExampleCptExampleMeta';

const { registerPlugin } = wp.plugins;

registerPlugin('rareview-example-cpt-example-meta-sidebar', {
	render() {
		return <ExampleCptExampleMeta />;
	},
});
