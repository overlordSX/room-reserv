// @ts-ignore
declare module '@vueform/multiselect';

// @ts-ignore
import { PageProps as InertiaPageProps } from '@inertiajs/core';
import { AxiosInstance } from 'axios';
// @ts-ignore
import ziggyRoute, { Config as ZiggyConfig } from 'ziggy-js';

// @ts-ignore
import { PageProps as AppPageProps } from './';

declare global {
    interface Window {
        axios: AxiosInstance;
    }

    let route: typeof ziggyRoute;
    let Ziggy: ZiggyConfig;
}

// @ts-ignore
declare module 'vue' {
    interface ComponentCustomProperties {
        route: typeof ziggyRoute;
    }
}

// @ts-ignore
declare module '@inertiajs/core' {
    interface PageProps extends InertiaPageProps, AppPageProps {}
}
