<?php 

namespace RistekUSDI\SSO\Laravel\Middleware\Web;

use Closure;

class RoleActive {

	/**
	 * Handle if user currently in a role active.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, ...$roles)
	{	
		// Make sure that we receive array with value is not empty.
        $roles = array_unique(array_filter(explode('|', ($roles[0] ?? ''))));
		if (! auth('imissu-web')->user()->hasRoleActive($roles)) {
            abort(403, "Anda tidak diijinkan mengakses sumber ini!");
        }

        return $next($request);
	}
}