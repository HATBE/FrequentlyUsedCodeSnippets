SILENT=false

readonly F_R=$(tput setaf 1) # red
readonly F_G=$(tput setaf 2) # green
readonly F_Y=$(tput setaf 3) # yellow
readonly F_B=$(tput setaf 4) # blue
readonly F_C=$(tput setaf 6) # cyan
readonly F_X=$(tput sgr0) 

function __messages() { # __messages <type> <message>
    local MODE=$1
    shift
    if $SILENT; then return; fi
    case "${MODE}" in
        'error') echo "${F_R}[Error]:${F_X} ${@}!" >&2;; # display error & redirect to stderr
        'success') echo "${F_G}[Success]:${F_X} ${@}.";; #display success
        'info') echo "${F_B}[Info]:${F_X} ${@}.";; # display info
        'warn') echo "${F_Y}[Warning]:${F_X} ${@}!";; # display warning
        *) echo "${@}";; # display just the plain message
    esac
}

__messages 'error' 'This is a error'
__messages 'success' 'This is a success'
__messages 'info' 'This is a info'
__messages 'warn' 'This is a warning'
