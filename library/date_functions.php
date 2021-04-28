<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/properties.php";

function try_to_int($obj) {
    try {
        (int)$obj = (int)$obj;
        return (int)$obj;
    } catch (Warning $warn) {
        return $obj;
    }
}

function can_to_int($obj) {
    try {
        (int)$obj2 = (int)$obj;
        if ((string)$obj2 != $obj) {
            return false;
        } else {
            return true;
        }
    } catch (Warning $warn) {
        return false;
    }
}

function validate_ppd($ppd) {
    $parts = explode(" ", $ppd);
    if ($parts[0] == $ppd) {
        return false;
    } else {
        $dateparts = explode("/", $parts[0]);
        $timeparts = explode(":", $parts[1]);
        if ($dateparts == $parts[0]) {
            return false;
        } else {
            if ($timeparts == $parts[1]) {
                return false;
            } else {
                if (count($dateparts) == 3 && count($timeparts) == 2) {
                    if (can_to_int($dateparts[0]) && can_to_int($dateparts[1]) && can_to_int($dateparts[2]) && can_to_int($timeparts[0]) && can_to_int($dateparts[1])) {
                        if ((int)$dateparts[0] > 0 && (int)$dateparts[0] <= 31 && (int)$dateparts[1] > 0 && (int)$dateparts[1] <= 12 && (int)$dateparts[2] > 2015 && (int)$dateparts[2] <= 30000 && (int)$timeparts[0] >= 0 && (int)$timeparts[0] <= 23 && (int)$timeparts[1] >= 0 && (int)$timeparts[0] < 60) {
                            if ((int)$dateparts[1] == 4 && (int)$dateparts[0] > 30) {
                                return false;
                            }
                            if ((int)$dateparts[1] == 6 && (int)$dateparts[0] > 30) {
                                return false;
                            }
                            if ((int)$dateparts[1] == 9 && (int)$dateparts[0] > 30) {
                                return false;
                            }
                            if ((int)$dateparts[1] == 11 && (int)$dateparts[0] > 30) {
                                return false;
                            }
                            if ((int)$dateparts[1] == 2 && (int)$dateparts[0] > 29) {
                                return false;
                            }
                            return true;
                        } else {
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            }
        }
    }
}

function correct_ppd($ppd) {
    $parts = explode(" ", $ppd);
    if ($parts[0] == $ppd) {
        return false;
    } else {
        $dateparts = explode("/", $parts[0]);
        $timeparts = explode(":", $parts[1]);
        if ($dateparts == $parts[0]) {
            return false;
        } else {
            if ($timeparts == $parts[1]) {
                return false;
            } else {
                if (count($dateparts) == 3 && count($timeparts) == 2) {
                    if (can_to_int($dateparts[0]) && can_to_int($dateparts[1]) && can_to_int($dateparts[2]) && can_to_int($timeparts[0]) && can_to_int($dateparts[1])) {
                        if ((int)$dateparts[0] > 0 && (int)$dateparts[0] <= 31 && (int)$dateparts[1] > 0 && (int)$dateparts[1] <= 12 && (int)$dateparts[2] > 2015 && (int)$dateparts[2] <= 30000 && (int)$timeparts[0] >= 0 && (int)$timeparts[0] <= 23 && (int)$timeparts[1] >= 0 && (int)$timeparts[0] < 60) {
                            if ((int)$dateparts[1] == 4 && (int)$dateparts[0] > 30) {
                                return false;
                            }
                            if ((int)$dateparts[1] == 6 && (int)$dateparts[0] > 30) {
                                return false;
                            }
                            if ((int)$dateparts[1] == 9 && (int)$dateparts[0] > 30) {
                                return false;
                            }
                            if ((int)$dateparts[1] == 11 && (int)$dateparts[0] > 30) {
                                return false;
                            }
                            if ((int)$dateparts[1] == 2 && (int)$dateparts[0] > 29) {
                                return false;
                            }
                            return (int)$dateparts[0] . "/" . (int)$dateparts[1] . "/" . (int)$dateparts[2] . " " . (int)$timeparts[0] . ":" . (int)$timeparts[1];
                        } else {
                            return false;
                        }
                    }
                } else {
                    return false;
                }
            }
        }
    }
}

function add_offset_ppd($date, $offset) {
    if (is_null($date) || is_null(validate_ppd($date))) {
        echo("<span style=\"color:red;\">PPDCONV Runtime Error: Null date or null date validation</span>");
        return;
    } else {
        if (is_bool($date)) {
            echo("<span style=\"color:red;\">PPDCONV Runtime Error: Boolean date</span>");
            return;
        }
        $parts = explode(" ", $date);
        $dateparts = explode("/", $parts[0]);
        $timeparts = explode(":", $parts[1]);
        $timeparts[0] = $timeparts[0] + $offset;

        if ($timeparts[0] >= 24) {
            $timeparts[0] = $timeparts[0] - 24;
            $dateparts[0] = $dateparts[0] + 1;
        }

        if ($dateparts[0] > 31) {
            $dateparts[1] = $dateparts[1] + 1;
            $dateparts[0] = 1;
        }

        if ($dateparts[0] > 30 && $dateparts[1] == 4) {
            $dateparts[1] = $dateparts[1] + 1;
            $dateparts[0] = 1;
        }

        if ($dateparts[0] > 30 && $dateparts[1] == 6) {
            $dateparts[1] = $dateparts[1] + 1;
            $dateparts[0] = 1;
        }

        if ($dateparts[0] > 30 && $dateparts[1] == 9) {
            $dateparts[1] = $dateparts[1] + 1;
            $dateparts[0] = 1;
        }

        if ($dateparts[0] > 30 && $dateparts[1] == 11) {
            $dateparts[1] = $dateparts[1] + 1;
            $dateparts[0] = 1;
        }

        $bisect = $dateparts[2] / 4;
        if (round($bisect) == $bisect) {
            $bisect = true;
        } else {
            $bisect = false;
        }
        
        if ($bisect) {
            if ($dateparts[0] > 29 && $dateparts[1] == 2) {
                $dateparts[1] = $dateparts[1] + 1;
                $dateparts[0] = 1;
            }
        } else {
            if ($dateparts[0] > 28 && $dateparts[1] == 2) {
                $dateparts[1] = $dateparts[1] + 1;
                $dateparts[0] = 1;
            }
        }

        if ($dateparts[1] > 12) {
            $dateparts[2] = $dateparts[2] + 1;
            $dateparts[1] = 1;
        }

        if ($dateparts[0] < 10) {
            $dateparts[0] = "0" . $dateparts[0];
        }

        if ($dateparts[1] < 10) {
            $dateparts[1] = "0" . $dateparts[1];
        }

        if ($timeparts[0] < 10) {
            $timeparts[0] = "0" . $timeparts[0];
        }

        if ($timeparts[1] < 10) {
            $timeparts[1] = "0" . $timeparts[1];
        }

        return (string)$dateparts[0] . "/" . (string)$dateparts[1] . "/" . (string)$dateparts[2] . " " . (string)$timeparts[0] . ":" . (string)$timeparts[1];
    }
}

function getTimezone($user) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/timezone")) {
        return (int)trim(file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/data/" . $user . "/timezone")) - 2;
    } else {
        return "0";
    }
}