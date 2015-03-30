<?php namespace Anomaly\FilesModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class FilesModule
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 * @package       Anomaly\FilesModule
 */
class FilesModule extends Module
{

    /**
     * The module navigation role.
     *
     * @var string
     */
    protected $navigation = 'streams::navigation.content';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'browser' => [
            'buttons' => [
                'upload' => [
                    'button'     => 'success',
                    'icon'       => 'upload',
                    'text'       => 'module::button.upload',
                    'attributes' => [
                        'data-toggle-uploader' => 'uploader'
                    ]
                ],
                [
                    'button' => 'new_folder',
                    'href'   => 'admin/files/folders/create'
                ]
            ]
        ],
        'drives'  => [
            'buttons' => [
                'new_drive'
            ]
        ],
        'settings'
    ];

}
