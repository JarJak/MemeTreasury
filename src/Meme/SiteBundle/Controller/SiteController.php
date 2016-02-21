<?php

namespace Meme\SiteBundle\Controller;

use Meme\CoreBundle\Controller\BaseController;

class SiteController extends BaseController
{
    public function homepageAction()
    {
        return $this->render('SiteBundle:Site:homepage.html.twig');
    }
}
