export default function getLocalization(stringKey) {
  if (typeof window.acdfevelop_screenReaderText === 'undefined' || typeof window.acdfevelop_screenReaderText[stringKey] === 'undefined') {
    // eslint-disable-next-line no-console
    console.error(`Missing translation for ${stringKey}`);
    return '';
  }
  return window.acdfevelop_screenReaderText[stringKey];
}
