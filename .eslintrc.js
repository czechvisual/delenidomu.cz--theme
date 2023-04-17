module.exports = {
  root: true,
  ignorePatterns: [
    '**/node_modules/*.js',
    'gulpfile.js'
  ],
  extends: [],
  rules: {
    indent: ['error', 2],
  },
  env: {
    browser: true,
    jquery: true,
  },
};
