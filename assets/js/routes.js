import About from "./components/pages/About";
import Projects from "./components/pages/Projects";
import Contact from "./components/pages/Contact";
import Project from "./components/pages/Project";
import ProjectsList from "./components/ProjectsList";
import TransitionRouter from "./components/TransitionRouter";
import i18n from "./i18n";

export const routes = [
    {
        path: '/',
        redirect: `/${i18n.locale}`
    },
    {
        path: '/:locale',
        component: TransitionRouter,
        beforeEnter: (to, from, next) => {
            i18n.locale = to.params.locale;
            return next();
        },
        children: [
            {
                path: '',
                name: 'about',
                component: About,
                meta: { order: 1 }
            },
            {
                path: 'projects',
                component: Projects,
                children: [
                    {
                        path: '',
                        name: 'projects',
                        component: ProjectsList,
                        meta: { order: 2 }
                    },
                    {
                        path: ':slug',
                        name: 'project',
                        component: Project,
                    },
                ]
            },
            {
                path: 'contact',
                name: 'contact',
                component: Contact,
                meta: { order: 3 }
            },
        ]
    },
];
