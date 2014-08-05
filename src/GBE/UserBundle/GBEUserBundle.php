<?php

namespace GBE\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GBEUserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}
