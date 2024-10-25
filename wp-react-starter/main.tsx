// NPM Modules
import React from 'react';
import { createRoot } from 'react-dom/client';

// Custom Modules
import './assets/scss/styles.scss';
import App from './App';

// Mount the App component to the #app element
const rootElement = document.getElementById('app');
if (rootElement) {
  const root = createRoot(rootElement);
  root.render(<App />);
} else {
  console.error("Root element with id 'app' not found.");
}
