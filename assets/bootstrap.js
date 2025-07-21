// assets/bootstrap.js
import { startStimulusApp } from '@symfony/stimulus-bridge';
import '@symfony/ux-turbo';

// 👇 ceci charge controllers.json via l'alias Webpack
import controllerMap from '@symfony/stimulus-bridge/controllers.json';

const app = startStimulusApp();
app.load(controllerMap);
