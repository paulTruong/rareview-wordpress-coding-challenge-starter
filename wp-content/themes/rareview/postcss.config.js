// eslint-disable-next-line import/extensions
const baseConfig = require('10up-toolkit/config/postcss.config.js');

const additionalPlugins = { 'postcss-svg': {} };

module.exports = (props) => {
	const config = baseConfig(props);

	config.plugins = { ...config.plugins, ...additionalPlugins };

	return config;
};
