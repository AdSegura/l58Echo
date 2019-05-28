import Home from './components/Home';

export default {
    base: '/home',
    mode: 'hash',
    routes: [
        {
            path: '/',
            component: Home
        }
    ]
}