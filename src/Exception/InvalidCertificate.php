<?php

declare(strict_types=1);

namespace Dealerweb\ECoc\Exception;

use RuntimeException;

/**
 * The document is no IVI data set: not well-formed, of another kind, or without the identification number of a vehicle.
 */
final class InvalidCertificate extends RuntimeException {}
