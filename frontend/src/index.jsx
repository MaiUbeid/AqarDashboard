import React from "react";
import ReactDOM from "react-dom";
import "./index.scss";
import App from "./app/App";
import * as serviceWorker from "./serviceWorker";
// import i18n (needs to be bundled ;))
import 'i18n';
import * as Sentry from "@sentry/react";
import { Integrations } from "@sentry/tracing";

ReactDOM.render(<App />, document.getElementById("root"));

if (!window.location.href.startsWith('http://localhost')) {
    Sentry.init({
        dsn: "https://048d615fdc2b4d8f8a511f709b02dbd8@o555534.ingest.sentry.io/5685743",
        integrations: [new Integrations.BrowserTracing()],

        // Set tracesSampleRate to 1.0 to capture 100%
        // of transactions for performance monitoring.
        // We recommend adjusting this value in production
        tracesSampleRate: 1.0,
    });
}

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
