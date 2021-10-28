import i18n from '@admin/i18n'

export default [
    {
        icon: 'mdi-account-multiple',
        title: i18n.t('drawer.user'),
        to: '/users'
    },
    {
        icon: 'mdi-file',
        title: i18n.t('drawer.file'),
        to: '/files'
    },
    {
        icon: 'mdi-server',
        title: i18n.t('drawer.server.base'),
        group: '/server',
        children: [
            {
                title:  i18n.t('drawer.server.statistics'),
                to: '/',
            },
            {
                title:  i18n.t('drawer.server.roles'),
                to: '/',
            },
            {
                title:  i18n.t('drawer.server.config'),
                to: '/',
            },
        ]
    },
]