// NPM Modules
import React, { Component } from 'react';

// Custom Modules
import SampleSection from './components/SampleSection';

export default class App extends Component {
  render() {
    return (
      <div>
        <h1>Hello from React Class Component!</h1>
        <SampleSection />
      </div>
    );
  }
}
