function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/admin', name: 'admin', redirect: { name: 'admin.dashboard' } },

  // Рабочий стол
  {
    path: '/admin/dashboard',
    name: 'admin.dashboard',
    redirect: { name: 'admin.users' }
    // component: page('admin/dashboard.vue'),
    // meta: {
    //   breadcrumb: [
    //     { name: 'dashboard' }
    //   ]
    // }
  },

  // Пользователи
  {
    path: '/admin/users',
    name: 'admin.users',
    component: page('admin/users/list.vue'),
    meta: {
      breadcrumb: [
        { name: 'dashboard', link: { name: 'admin.dashboard' }, icon: 'house-fill' },
        { name: 'users' }
      ]
    }
  },
  {
    path: '/admin/users/create',
    name: 'admin.users.create',
    component: page('admin/users/create.vue'),
    meta: {
      breadcrumb: [
        { name: 'dashboard', link: { name: 'admin.dashboard' }, icon: 'house-fill' },
        { name: 'users', link: { name: 'admin.users' } },
        { name: 'creating' }
      ]
    }
  },
  {
    path: '/admin/users/:id',
    name: 'admin.users.edit',
    component: page('admin/users/edit.vue'),
    meta: {
      breadcrumb: [
        { name: 'dashboard', link: { name: 'admin.dashboard' }, icon: 'house-fill' },
        { name: 'users', link: { name: 'admin.users' } },
        { name: 'updating' }
      ]
    }
  },

  // Разделы
  {
    path: '/admin/sections',
    name: 'admin.sections',
    component: page('admin/sections/list.vue'),
    meta: {
      breadcrumb: [
        { name: 'dashboard', link: { name: 'admin.dashboard' }, icon: 'house-fill' },
        { name: 'sections' }
      ]
    }
  },
  {
    path: '/admin/sections/create',
    name: 'admin.sections.create',
    component: page('admin/sections/create.vue'),
    meta: {
      breadcrumb: [
        { name: 'dashboard', link: { name: 'admin.dashboard' }, icon: 'house-fill' },
        { name: 'sections', link: { name: 'admin.sections' } },
        { name: 'creating' }
      ]
    }
  },
  {
    path: '/admin/sections/:id',
    name: 'admin.sections.edit',
    component: page('admin/sections/edit.vue'),
    meta: {
      breadcrumb: [
        { name: 'dashboard', link: { name: 'admin.dashboard' }, icon: 'house-fill' },
        { name: 'sections', link: { name: 'admin.sections' } },
        { name: 'updating' }
      ]
    }
  },

  // Задачи
  {
    path: '/admin/tasks',
    name: 'admin.tasks',
    component: page('admin/tasks/list.vue'),
    meta: {
      breadcrumb: [
        { name: 'dashboard', link: { name: 'admin.dashboard' }, icon: 'house-fill' },
        { name: 'tasks' }
      ]
    }
  },
  {
    path: '/admin/tasks/create',
    name: 'admin.tasks.create',
    component: page('admin/tasks/create.vue'),
    meta: {
      breadcrumb: [
        { name: 'dashboard', link: { name: 'admin.dashboard' }, icon: 'house-fill' },
        { name: 'tasks', link: { name: 'admin.tasks' } },
        { name: 'creating' }
      ]
    }
  },
  {
    path: '/admin/tasks/:id',
    name: 'admin.tasks.edit',
    component: page('admin/tasks/edit.vue'),
    meta: {
      breadcrumb: [
        { name: 'dashboard', link: { name: 'admin.dashboard' }, icon: 'house-fill' },
        { name: 'tasks', link: { name: 'admin.tasks' } },
        { name: 'updating' }
      ]
    }
  },

  // Настройки
  {
    path: '/admin/settings',
    component: page('admin/settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'admin.settings.profile' } },
      { path: 'profile', name: 'admin.settings.profile', component: page('admin/settings/profile.vue') },
      { path: 'password', name: 'admin.settings.password', component: page('admin/settings/password.vue') }
    ]
  },

  // 404
  { path: '*', component: page('admin/errors/404.vue') }
]
