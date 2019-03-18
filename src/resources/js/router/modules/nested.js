/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/views/layout/Layout';

const nestedRouter = {
  path: '/nested',
  component: Layout,
  redirect: '/nested/menu1',
  name: 'Nested',
  meta: {
    title: 'nested',
    icon: 'nested',
  },
  children: [
    {
      path: 'menu1',
      component: require('@/views/nested/menu1/index').default, // Parent router-view
      name: 'Menu1',
      meta: { title: 'menu1' },
      children: [
        {
          path: 'menu1-1',
          component: require('@/views/nested/menu1/menu1-1').default,
          name: 'Menu1-1',
          meta: { title: 'menu1-1' },
        },
        {
          path: 'menu1-2',
          component: require('@/views/nested/menu1/menu1-2').default,
          name: 'Menu1-2',
          meta: { title: 'menu1-2' },
          children: [
            {
              path: 'menu1-2-1',
              component: require('@/views/nested/menu1/menu1-2/menu1-2-1')
                .default,
              name: 'Menu1-2-1',
              meta: { title: 'menu1-2-1' },
            },
            {
              path: 'menu1-2-2',
              component: require('@/views/nested/menu1/menu1-2/menu1-2-2')
                .default,
              name: 'Menu1-2-2',
              meta: { title: 'menu1-2-2' },
            },
          ],
        },
        {
          path: 'menu1-3',
          component: require('@/views/nested/menu1/menu1-3').default,
          name: 'Menu1-3',
          meta: { title: 'menu1-3' },
        },
      ],
    },
    {
      path: 'menu2',
      component: require('@/views/nested/menu2/index').default,
      meta: { title: 'menu2' },
    },
  ],
};

export default nestedRouter;
