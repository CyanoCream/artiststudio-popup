# Artistudio Popup Plugin

A WordPress plugin for displaying custom popups using React and WordPress REST API.

## Installation

1. Clone this repository to your WordPress plugins directory:
```bash
cd wp-content/plugins
git clone [repository-url] artistudio-popup
```

2. Install dependencies:
```bash
cd artistudio-popup
npm install
```

3. Compile assets:
```bash
npm run build
```

4. Activate the plugin in WordPress admin panel.

## Usage

1. Create new popups from the WordPress admin panel under "Pop Ups" menu.
2. Set the page path where you want the popup to appear in the "Page" field.
3. Add your content using the WordPress editor.
4. The popup will automatically appear when users visit the specified page.

## Development

- Run `npm run watch` for development
- Run `npm run build` for production build

## Requirements

- WordPress 5.0+
- PHP 7.4+
- Node.js 14+