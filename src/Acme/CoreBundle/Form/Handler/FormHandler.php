<?php

namespace Acme\CoreBundle\Form\Handler;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FormHandler
 *
 * This class acts as a generic form handler
 *
 * @package FloSports\CoreBundle\Form\Handler
 */
class FormHandler
{
    /**
     * @var FormFactoryInterface
     */
    protected $formFactory;

    /**
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    /**
     * Saves a thread and returns the form
     *
     * @param mixed $data
     * @param mixed $request
     * @param string $formType
     * @param array $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function processForm($data, $request, $formType, array $options = [])
    {
        if ($request instanceof Request) {
            $request = $request->request->all();
        }

        $form = $this->formFactory->create($formType, $data, $options);
        $form->submit($request);

        return $form;
    }
}