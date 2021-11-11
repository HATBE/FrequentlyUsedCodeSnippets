SILENT=false

readonly F_RED=$(tput setaf 1)
readonly F_GREEN=$(tput setaf 2)
readonly F_YELLOW=$(tput setaf 3)
readonly F_RESET=$(tput sgr0)

messages() {
    if $SILENT; then return; fi
    local MODE=$1
    shift
    case "${MODE}" in
        error) echo "${F_RED}[Error]: ${F_RESET}${@}!" >&2 ;;
        success) echo "${F_GREEN}[Success]: ${F_RESET}${@}." ;;
        info) echo "${F_BLUE}[Info]: ${F_RESET}${@}." ;;
        warn) echo "${F_YELLOW}[Warn]: ${F_RESET}${@}!" ;;
        *) echo "${@}." ;;
    esac
}

messages 'error' 'This is an error'
