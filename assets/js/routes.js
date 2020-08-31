import About from "./components/pages/About";
import Projects from "./components/pages/Projects";
import Contact from "./components/pages/Contact";
import Project from "./components/pages/Project";
import ProjectsList from "./components/ProjectsList";

export const routes = [
    {
        path: '/',
        name: 'about',
        component: About,
        meta: {
            title: 'O mnie',
            order: 1
        }
    },
    {
        path: '/projects',
        component: Projects,
        children: [
            {
                path: '',
                component: ProjectsList,
                meta: {
                    title: 'Projekty',
                    order: 2
                }
            },
            {
                path: ':slug',
                component: Project,
                meta: {title: 'Projekt'}
            },
        ]
    },
    {
        path: '/contact',
        component: Contact,
        meta: {
            title: 'Kontakt',
            order: 3
        }
    },
];
