import login from '../index.php'
import Menu from '../vista/MenuPrincipal/Menu_principal.php'


Vue.use(Router)

export default new Router({
routes:[
    {
        path:'',
        name:'Menu_Principal',
        component:Menu
    }
]
})