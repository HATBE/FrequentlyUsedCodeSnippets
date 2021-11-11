SILENT=false

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