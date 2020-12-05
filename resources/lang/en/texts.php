<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Static Texts Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are the default lines which match all
    | static texts found on website.
    |
    */

    'auth'      => [
        'sign-in-page-title' => 'Sign in (customer)',
        'sign-up-page-title' => 'Sign up (customer)',

        'sign-in-freelancer-page-title' => 'Sign in (freelancer)',
        'sign-up-freelancer-page-title' => 'Sign up (freelancer)',


        'are-you-freelancer' => 'Are you freelancer?',
        'are-you-customer'   => 'Are you customer?',

        'sign-in' => 'Sign in as customer',
        'sign-up' => 'Sign up as customer',

        'sign-in-freelancer' => 'Sign in as freelancer',
        'sign-up-freelancer' => 'Sign up as freelancer',

        'sign-in-base' => 'Sign in',
        'sign-up-base' => 'Sign up',

        'login'             => 'Login (email)',
        'login-placeholder' => 'Login',

        'name' => 'Name',

        'password'              => 'Password',
        'password-confirmation' => 'Password Confirmation',

        'remember' => 'Remember',
        'submit'   => 'Go',

        'have-no-account'      => 'Have no account?',
        'already-have-account' => 'Already have account?',
    ],
    'dashboard' => [

        'proposals'   => [
            'create'      => 'Create new',
            'create-form' => [
                'title'          => 'Create new proposal for :jobName job',
                'cover-letter'   => 'Cover letter',
                'estimated_time' => 'Estimated time, hours',
            ],
            'update-form' => [
                'title' => 'Edit proposal',
            ]
        ],
        'index'       => [
            'page-title' => 'Dashboard',
            'header'     => 'You are in dashboard!',
        ],
        'sidebar'     => [
            'menu'      => 'Menu',
            'dashboard' => 'Dashboard',

            'explore-jobs' => 'Explore jobs',

            'jobs'        => 'Jobs',
            'all-jobs'    => 'All jobs',
            'applied-on'  => 'Applied on',
            'in-work'     => 'Jobs In work',
            'finished'    => 'Finished Jobs',
            'add-new-job' => 'Add new',
            'job-reports' => 'Job Reports',

            'logout' => 'Logout',
        ],
        'offers'      => [
            'select-job'            => 'Select Job',
            'enter-name'            => 'Job title',
            'enter-description'     => 'Enter description',
            'select-date-to-delete' => 'Date to be deleted at',

            'table'    => [
                'name'        => 'Job title',
                'description' => 'Short Description',
                'actions'     => 'Actions',

                'buttons' => [
                    'view' => 'View',
                    'edit' => 'Edit'
                ],

                'empty'          => 'You have not posted a single offer.',
                'empty-in-work'  => 'There are no jobs freelancers are working on.',
                'empty-finished' => 'Not a single job has been finished.',

                'empty-freelancer' => 'Currently there are no available jobs.',
            ],
            'explore'  => [
                'index' => [
                    'page-title' => 'Explore jobs',
                ]
            ],
            'finished' => [
                'page-title' => 'Finished Jobs',
                'title'      => 'Finished Jobs',
            ],
            'in-work'  => [
                'page-title' => 'Jobs in work',
                'title'      => 'Jobs in work',
            ],

            'index'  => [
                'page-title'            => 'Your job offers',
                'page-title-freelancer' => 'Available job offers',
                'title'                 => 'List of jobs',
                'add-new'               => 'Add new',
            ],
            'create' => [
                'page-title' => 'Create job offer',

                'title'  => 'Create new offer',
                'submit' => 'Create'
            ],
            'show'   => [
                'page-title' => 'Job info',

                'title'          => 'Job information',
                'proposals-list' => 'List of proposals:',

                'edit-btn' => 'Edit',

                'name'        => 'Name',
                'description' => 'Description',

                'manage-links' => 'Manage job links',

            ],
            'edit'   => [
                'page-title' => 'Edit job',

                'current-content' => 'Job contents',
                'title'           => 'Edit job information',
                'submit'          => 'Save',
            ],
            'delete' => [
                'button' => 'Delete',
            ],

            'errors' => [
                'update' => 'Could not update job information',
            ]
        ],
        'job-links'   => [
            'of-job' => [
                'page-title' => 'Links',
            ],
            'create' => [
                'page-title' => 'Add new',
            ],

            'form-elements' => [
                'select-type'    => 'Select link type',
                'select-default' => 'Select one of'
            ],

            'create-form' => [
                'title'  => 'Create new link',
                'submit' => 'Go',
            ],

            'title'          => 'Links',
            'table'          => [
                'link-url' => 'Link URL',
                'type'     => 'Type',
                'status'   => 'Status',
                'actions'  => 'Actions',
            ],
            'list-empty'     => 'List of links is empty. You can create new link using the button below.',
            'create-new-btn' => 'Create new link',

            'buttons' => [
                'delete' => 'Delete'
            ],

            'errors' => [
                'create' => 'Could not create link'
            ]
        ],
        'job-reports' => [
            'index' => [
                'page-title' => 'Statistics',

                'title'              => 'Job Statistics',
                'jobs-count'         => 'Jobs now',
                'deleted-jobs-count' => 'Deleted jobs',
            ],
            'table' => [
                'name'                  => 'Name',
                'disposable-links-used' => 'Disposable links used',
                'unlimited-links-views' => 'Unlimited links views',
                'views-count'           => 'Total views count',
                'summary'               => 'Summary',

                'empty' => 'There are no jobs'
            ]
        ],
    ],

    'guest' => [
        'view' => [
            'jobs' => [
                'title' => 'Job contents'
            ]
        ]
    ],

    'datepicker' => [
        'date' => 'Date'
    ],

    'entities' => [
        'link-token' => [
            'types'  => [
                'disposable' => 'Disposable',
                'unlimited'  => 'Unlimited',
            ],
            'status' => [
                'not-used'     => 'Not used',
                'used-n-times' => 'Used %d times',
                'expired'      => 'Expired',
            ]
        ]
    ],
];
