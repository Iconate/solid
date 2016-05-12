<?php
/**
 * ====================================
 *      Middleware Structure
 * ====================================
 *
 * [
 *      $HANDLE - Name to invoke
 *      $CLASS  - Class name (aliases accepted)
 *      $METHOD - Method contained within the class to call
 * ]
 */
return [
	['auth', 'Authorization', 'authorize']
];