<?php namespace Cribbb\Infrastructure\Services;

use Illuminate\Hashing\BcryptHasher;
use Cribbb\Domain\Model\Identity\Password;
use Cribbb\Domain\Model\Identity\HashingService;
use Cribbb\Domain\Model\Identity\HashedPassword;

class BcryptHashingService implements HashingService {

  /**
   * @var Illuminate\Hashing\BcryptHasher
   */
  private $hasher;

  /**
   * Create a new PasswordHashingService
   *
   * @param BcryptHasher $hasher
   * @return void
   */
  public function __construct(BcryptHasher $hasher)
  {
    $this->hasher = $hasher;
  }

  /**
   * Create a new HashedPassword
   *
   * @param Password $password
   * @return HashedPassword
   */
  public function make(Password $password)
  {
    return new HashedPassword($this->hasher->make((string) $password));
  }

  /**
   * Check if the password is valid
   *
   * @param Password $password
   * @param HashedPassword $hashed
   * @return bool
   */
  public function check(Password $password, HashedPassword $hashed)
  {
    return $this->hasher->check((string) $password, (string) $hashed);
  }

}