import "../fake-db";
import React, { Suspense } from "react";
import "../styles/app/app.scss";

import { Provider } from "react-redux";
import { Router } from "react-router-dom";
import AppContext from "./appContext";
import history from "@history";

import routes from "./RootRoutes";
import { Store } from "./redux/Store";
import { renderRoutes } from "react-router-config";
import Auth from "./auth/Auth";
import RootRoutes from "./RootRoutes";
import { Loading } from "@gull";

function App() {
  return (
    <AppContext.Provider value={{ routes }}>
      <Provider store={Store}>
        <Auth>
          <Suspense fallback={<Loading></Loading>}>
            <Router history={history}>{renderRoutes(RootRoutes)}</Router>
          </Suspense>
        </Auth>
      </Provider>
    </AppContext.Provider>
  );
}

export default App;
