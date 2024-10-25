// Core Modules
import { exec } from 'child_process';
import path from 'path';
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [
    react(),
    {
      name: 'watch-src-folder-and-run-script',
      handleHotUpdate({ file, server }) {
        const relativeFilePath = path.relative(server.config.root, file);

        // Only trigger when files in the /src folder are changed
        if (relativeFilePath.startsWith('src/')) {
          console.log(`File in /src changed: ${file}`);

          // Trigger your custom NPM script
          exec('npm run build:dev', (err, stdout, stderr) => {
            if (err) {
              console.error(`Error running script: ${err}`);
              return;
            }
            console.log(`Script output: ${stdout}`);
          });
        }
      }
    }
  ],
  build: {
    outDir: 'dist',
    rollupOptions: {
      input: './src/main.tsx', // Use main entry point
      output: {
        entryFileNames: 'assets/[name].js',
        chunkFileNames: 'assets/[name].js',
        assetFileNames: (assetInfo) => {
          // Explicitly name styles.scss as styles.css
          if (assetInfo.name === 'styles.css' || assetInfo.name === 'styles.scss') {
            return 'assets/styles.css';
          }
          return 'assets/[name].[ext]';
        }
      }
    },
    assetsDir: 'assets', // Place all assets in the assets directory within dist
    sourcemap: true, // Optional: Generates source maps for easier debugging
    emptyOutDir: true // Ensures dist folder is cleaned before each build
  }
});
