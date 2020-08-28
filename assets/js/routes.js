import About from "./components/pages/About";
import Projects from "./components/pages/Projects";
import Contact from "./components/pages/Contact";
import Project from "./components/pages/Project";
import ProjectsList from "./components/ProjectsList";

export const routes = [
    { path: '/', name: 'about', component: About, meta: { order: 1 } },
    { path: '/projects', component: Projects,
        children: [
            { path: '', component: ProjectsList, meta: {order: 2} },
            { path: ':slug', component: Project },
        ]
    },
    { path: '/contact', component: Contact, meta: { order: 3 } },
];
